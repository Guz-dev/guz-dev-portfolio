<div class="max-w-4xl mx-auto p-6 dark:text-white">
    <h2 class="text-2xl font-bold mb-2">
        {{ __('projects.earthquake-tracker.title') }}
    </h2>

    <p class="mb-4">
        {{ __('projects.earthquake-tracker.description') }}
    </p>

    {{-- 
    <button
        wire:click="refreshData"
        class="mb-6 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded cursor-pointer"
    >
        {{ __('projects.earthquake-tracker.update_button') }}
    </button>
     --}}

    <div wire:ignore id="dashboard_div">
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
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-600">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Fecha y Hora</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Magnitud</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Profundidad (km)</th>
                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Ubicación</th>
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
                            {{ $eq['location'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', { packages: ['corechart','controls'] })    
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        let data = google.visualization.arrayToDataTable(@json($chartData));        
        
        let options = {
            title: 'Magnitud vs Profundidad de Sismos en Chile',
            hAxis: { title: 'Profundidad (km)' },
            vAxis: { title: 'Magnitud' },
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
                'filterColumnIndex': 1,
                'minValue': {{ $minMagnitude }},
                'maxValue': {{ $maxMagnitude }},
                'ui': {
                    'labelStacking': 'vertical',
                    'label': 'Filtrar por Magnitud:',
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
                console.log("Gráfico dibujado");
            }
        );

        google.visualization.events.addListener(
            magnitudeControl,
            'statechange',
            function() {
                var state = magnitudeControl.getState();
                console.log("Filtro de magnitud cambiado", state.lowValue, state.highValue);

                console.log("Actualizando tabla de datos livewire con funcion loadEarthquakesFromDB");

                @this.set('minMagnitude', state.lowValue || 0);
                @this.set('maxMagnitude', state.highValue || 10);
                
                @this.loadEarthquakesFromDB();
            }
        );

        console.log("Eventos creados");


    }

    
    console.log("Ejecutando script");
    
    
</script>