<?php

namespace App\Livewire\Projects\EarthquakeTracker;

use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Models\Earthquake;
use Exception;

class EarthquakeTracker extends Component
{
    public $earthquakes = [];
    public $chartData = [];

    public float $minMagnitude = 0;
    public float $maxMagnitude = 10;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->loadEarthquakesFromDB();
    }

    public function loadEarthquakesFromDB()
    {
        $this->earthquakes = Earthquake::where('magnitude', '>=', $this->minMagnitude)
            ->where('magnitude', '<=', $this->maxMagnitude)
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
    }

    public function updating($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property

        // error_log("updating property: $property to value: $value");
    }

    public function refreshData()
    {
        // Obtener datos desde sismologia.cl        
        if (app()->environment('local')) {
            // Simular error en entorno local para pruebas
            $response = Http::withoutVerifying()->get('https://www.sismologia.cl/');            
        } else {
            $response = Http::get('https://www.sismologia.cl/');
        }

        if (! $response->ok()) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'No se pudo obtener información desde sismologia.cl',
            ]);
            return;
        }

        $html = $response->body();

        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $xpath = new \DOMXPath($dom);

        // Todas las filas de la tabla
        $rows = $xpath->query('//table//tr');

        /** @var \DOMElement $row */
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');

            if ($cols->length < 3) {
                continue;
            }

            // Columna 1 → fecha + lugar
            $dateLink = $cols->item(0)->getElementsByTagName('a')->item(0);
            if (! $dateLink) continue;

            $datetime = trim($dateLink->textContent);

            $location = trim(
                str_replace($datetime, '', $cols->item(0)->textContent)
            );

            // Columna 2 → profundidad
            $depth = trim($cols->item(1)->textContent);
            $depth = (int) filter_var($depth, FILTER_SANITIZE_NUMBER_INT);

            // Columna 3 → magnitud
            $magnitude = (float) trim($cols->item(2)->textContent);

            Earthquake::updateOrCreate(
                [
                    'time' => $datetime,
                    'location' => $location,
                ],
                [
                    'magnitude' => $magnitude,
                    'depth' => $depth,
                ]
            );
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
