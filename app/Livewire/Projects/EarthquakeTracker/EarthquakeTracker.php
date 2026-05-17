<?php

namespace App\Livewire\Projects\EarthquakeTracker;

use App\Models\Earthquake;
use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EarthquakeTracker extends Component
{
    public $earthquakes = [];

    public $chartData = [];

    public float $minMagnitude = 0;

    public float $maxMagnitude = 10;

    public float $minDepth = 0;

    public float $maxDepth = 700;

    public array $summaryStats = [];

    public array $magnitudeDistribution = [];

    public array $depthDistribution = [];

    public array $timeDistribution = [];

    public int $page = 1;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->loadEarthquakesFromDB();
    }

    public function loadEarthquakesFromDB()
    {
        $this->page = 1;

        $this->earthquakes = Earthquake::where('magnitude', '>=', $this->minMagnitude)
            ->where('magnitude', '<=', $this->maxMagnitude)
            ->where('depth', '>=', $this->minDepth)
            ->where('depth', '<=', $this->maxDepth)
            ->orderBy('time', 'desc')
            ->limit(100)
            ->get()
            ->toArray();

        $earthquakeData = [['Profundidad (km)', 'Magnitud']];

        foreach ($this->earthquakes as $eq) {
            $earthquakeData[] = [
                intval($eq['depth']),
                floatval($eq['magnitude']),
            ];
        }

        $this->chartData = $earthquakeData;

        $magnitudes = array_column($this->earthquakes, 'magnitude');
        $depths = array_column($this->earthquakes, 'depth');
        $total = count($this->earthquakes);

        $this->summaryStats = [
            'total' => $total,
            'avg_magnitude' => $total > 0 ? round(array_sum($magnitudes) / $total, 1) : 0,
            'max_magnitude' => $total > 0 ? round(max($magnitudes), 1) : 0,
            'avg_depth' => $total > 0 ? round(array_sum($depths) / $total, 1) : 0,
        ];

        $magBins = [];
        for ($i = 0; $i < 10; $i += 1) {
            $magBins[sprintf('%d-%d', $i, $i + 1)] = 0;
        }
        $magBins['10+'] = 0;
        foreach ($this->earthquakes as $eq) {
            $mag = floatval($eq['magnitude']);
            $binIndex = (int) floor($mag);
            if ($binIndex >= 10) {
                $magBins['10+']++;
            } elseif (isset($magBins[sprintf('%d-%d', $binIndex, $binIndex + 1)])) {
                $magBins[sprintf('%d-%d', $binIndex, $binIndex + 1)]++;
            }
        }
        $this->magnitudeDistribution = [['Range', 'Count']];
        foreach ($magBins as $key => $count) {
            $this->magnitudeDistribution[] = [$key, $count];
        }

        $depthRanges = ['0-50', '50-100', '100-150', '150-200', '200-300', '300+'];
        $depthBins = array_fill_keys($depthRanges, 0);
        foreach ($this->earthquakes as $eq) {
            $depth = intval($eq['depth']);
            if ($depth <= 50) {
                $depthBins['0-50']++;
            } elseif ($depth <= 100) {
                $depthBins['50-100']++;
            } elseif ($depth <= 150) {
                $depthBins['100-150']++;
            } elseif ($depth <= 200) {
                $depthBins['150-200']++;
            } elseif ($depth <= 300) {
                $depthBins['200-300']++;
            } else {
                $depthBins['300+']++;
            }
        }
        $this->depthDistribution = [['Depth', 'Count']];
        foreach ($depthBins as $key => $count) {
            $this->depthDistribution[] = [$key, $count];
        }

        $timeGroups = [];
        foreach ($this->earthquakes as $eq) {
            $date = \Carbon\Carbon::parse($eq['time'])->format('Y-m-d');
            if (! isset($timeGroups[$date])) {
                $timeGroups[$date] = 0;
            }
            $timeGroups[$date]++;
        }
        ksort($timeGroups);
        $this->timeDistribution = [['Date', 'Count']];
        foreach ($timeGroups as $date => $count) {
            $this->timeDistribution[] = [$date, $count];
        }

        $this->dispatch('chartDataUpdated');
    }

    public function updating($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property

        // error_log("updating property: $property to value: $value");
    }

    public function refreshData()
    {
        $response = app()->environment('production')
            ? Http::get('https://api.boostr.cl/earthquakes/recent.json')
            : Http::withoutVerifying()->get('https://api.boostr.cl/earthquakes/recent.json');

        if (! $response->ok()) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'No se pudo obtener información desde la API',
            ]);

            return;
        }

        $earthquakes = $response->json()['data'] ?? [];

        foreach ($earthquakes as $item) {
            $eq = $item['data'] ?? $item;

            $date = $eq['date'] ?? '';
            $hour = $eq['hour'] ?? '';

            $datetime = $date.' '.$hour;
            $timestamp = strtotime($datetime);

            $depth = $eq['depth'] ?? '0';
            $depth = (int) filter_var($depth, FILTER_SANITIZE_NUMBER_INT);

            try {
                Earthquake::updateOrCreate(
                    ['time' => date('Y-m-d H:i:s', $timestamp)],
                    [
                        'location' => $eq['place'] ?? '',
                        'magnitude' => floatval($eq['magnitude'] ?? 0),
                        'depth' => $depth,
                    ]
                );
            } catch (Exception $e) {
                error_log('Error saving earthquake data: '.$e->getMessage());
            }
        }

        $this->loadEarthquakesFromDB();

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Datos sísmicos actualizados correctamente',
        ]);
    }

    public function render()
    {
        return view('livewire.projects.earthquake-tracker.earthquake-tracker',
            [
                'chartData' => $this->chartData,
            ]
        );
    }
}
