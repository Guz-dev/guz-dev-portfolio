<div class="max-w-4xl mx-auto p-6 dark:text-white">
    @section('title', __('projects.earthquake-tracker.title'))

    <h2 class="text-2xl font-bold mb-2">
        {{ __('projects.earthquake-tracker.title') }}
    </h2>

    <p class="mb-4">
        {{ __('projects.earthquake-tracker.description') }}
    </p>
    
    @if (env('APP_ENV') !== 'production')
    <button
        wire:click="refreshData"
        class="mb-6 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded cursor-pointer"
    >
    {{ __('projects.earthquake-tracker.update_button') }}
    </button>
    @endif

    <div wire:ignore id="dashboard_div" @if(count($earthquakes) === 0) style="display: none;" @endif>
        <div id="magnitude_filter_div" class="mb-4"></div>
        <div id="earthquake_chart" class="w-full h-96"></div>
    </div>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
        {{ __('projects.earthquake-tracker.data_source') }}
        <a 
            href="https://www.sismologia.cl"
            target="_blank"
            class="underline hover:text-blue-500"
        >
            Centro Sismológico Nacional (CSN)
        </a>
    </p>

    {{-- show the data table below--}}
    @if (count($earthquakes) !== 0)
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-600">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ __('projects.earthquake-tracker.table_labels.datetime') }}</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ __('projects.earthquake-tracker.table_labels.magnitude') }}</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ __('projects.earthquake-tracker.table_labels.depth') }}</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">{{ __('projects.earthquake-tracker.table_labels.location') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($earthquakes as $eq)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">
                            {{ \Carbon\Carbon::parse($eq['time'])->format('d/m/Y H:i:s') }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">
                            {{ number_format($eq['magnitude'], 1) }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">
                            {{ intval($eq['depth']) }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">
                            @php
                                $locationParts = explode(' de ', $eq['location']);
                                $distanceAndDirection = $locationParts[0] ?? '';
                                $locationName = $locationParts[1] ?? $eq['location'];

                                // Further split distance and direction
                                $distanceParts = explode(' al ', $distanceAndDirection);
                                $distance = $distanceParts[0] ?? '';
                                $cardinalDirection = $distanceParts[1] ?? '';
                            @endphp
                            {{ __('projects.earthquake-tracker.table_location_format', [
                                'distance' => trim($distance),
                                'cardinal_direction' => trim($cardinalDirection),
                                'location' => trim($locationName),
                            ]) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-gray-500 dark:text-gray-400">
            {{ __('projects.earthquake-tracker.no_earthquakes') }}
        </p>
    @endif

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    
    if(@json(count($chartData)) === 0) {
        document.getElementById('dashboard_div').style.display = 'none';
    }
    
    google.charts.load('current', { packages: ['corechart','controls'] })    
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        let data = google.visualization.arrayToDataTable(@json($chartData));

        data.setColumnLabel(0, '{{ __('projects.earthquake-tracker.table_labels.depth') }}');
        data.setColumnLabel(1, '{{ __('projects.earthquake-tracker.table_labels.magnitude') }}');

        // Add tooltips to the dot points based on depth and magnitude
        data.addColumn({ type: 'string', role: 'tooltip' });
        for (let i = 0; i < data.getNumberOfRows(); i++) {
            let depth = data.getValue(i, 0);
            let magnitude = data.getValue(i, 1);
            let tooltip = '{{ __('projects.earthquake-tracker.table_labels.depth') }}: ' + depth + ' km\n' +
                          '{{ __('projects.earthquake-tracker.table_labels.magnitude') }}: ' + magnitude;
            data.setValue(i, 2, tooltip);
        }
        
        let options = {
            title: '{{ __('projects.earthquake-tracker.chart_title') }}',
            hAxis: { title: '{{ __('projects.earthquake-tracker.hAxis_title') }}' },
            vAxis: { title: '{{ __('projects.earthquake-tracker.vAxis_title') }}' },
            legend: 'none',
            pointSize: 6,
            colors: ['#ef4444'],
        };
        
        let dashboard = new google.visualization.Dashboard(
            document.getElementById('earthquake_chart')
        );

        let magnitudeControl = new google.visualization.ControlWrapper({
            'controlType': 'NumberRangeFilter',
            'containerId': 'magnitude_filter_div',
            'options': {
                'filterColumnIndex': 1, // Magnitud column
                'minValue': {{ $minMagnitude }},
                'maxValue': {{ $maxMagnitude }},
                'ui': {
                    'labelStacking': 'vertical',
                    'label': '{{ __('projects.earthquake-tracker.magnitude_filter') }}',
                }
            }
        });

        let chart = new google.visualization.ChartWrapper({
            'chartType': 'ScatterChart',
            'containerId': 'earthquake_chart',
            'options': options
        });

        dashboard.bind(magnitudeControl, chart);

        dashboard.draw(data);

        google.visualization.events.addListener(
            chart,
            'ready',
            function() {
                //console.log("Gráfico dibujado");
            }
        );

        google.visualization.events.addListener(
            magnitudeControl,
            'statechange',
            function() {
                var state = magnitudeControl.getState();
                
                //console.log("Filtro de magnitud cambiado", state.lowValue, state.highValue);
                //console.log("Actualizando tabla de datos livewire con funcion loadEarthquakesFromDB");

                @this.set('minMagnitude', state.lowValue || 0);
                @this.set('maxMagnitude', state.highValue || 10);
                
                @this.loadEarthquakesFromDB();
            }
        );
        //console.log("Eventos creados");
    }
    //console.log("Ejecutando script");
</script>