<div class="max-w-6xl mx-auto p-6 dark:text-white">
    @section('title', __('projects.earthquake-tracker.title'))

    <div id="chart-data"
         data-scatter='@json($chartData)'
         data-mag-dist='@json($magnitudeDistribution)'
         data-depth-dist='@json($depthDistribution)'
         data-time-dist='@json($timeDistribution)'
         class="hidden"></div>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold">{{ __('projects.earthquake-tracker.title') }}</h2>
            <p class="text-gray-600 dark:text-gray-400">{{ __('projects.earthquake-tracker.description') }}</p>
        </div>
        <button
            wire:click="refreshData"
            @if (!$canRefresh) disabled @endif
            class="mt-2 md:mt-0 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            title="@if (!$canRefresh) {{ __('projects.earthquake-tracker.update_limit_reached') }} @endif"
        >
            {{ __('projects.earthquake-tracker.update_button') }}
        </button>
    </div>

    @if (count($summaryStats) > 0)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ __('projects.earthquake-tracker.stat_total') }}</p>
            <p class="text-2xl font-bold mt-1">{{ $summaryStats['total'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ __('projects.earthquake-tracker.stat_avg_magnitude') }}</p>
            <p class="text-2xl font-bold mt-1">{{ $summaryStats['avg_magnitude'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-yellow-500">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ __('projects.earthquake-tracker.stat_max_magnitude') }}</p>
            <p class="text-2xl font-bold mt-1">{{ $summaryStats['max_magnitude'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-purple-500">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ __('projects.earthquake-tracker.stat_avg_depth') }}</p>
            <p class="text-2xl font-bold mt-1">{{ $summaryStats['avg_depth'] }}</p>
        </div>
    </div>
    @endif

    @php
        $magValues = array_column($earthquakes, 'magnitude');
        $minMagRange = count($magValues) > 0 ? round(min($magValues), 1) : 0;
        $maxMagRange = count($magValues) > 0 ? round(max($magValues), 1) : 10;

        $depthValues = array_column($earthquakes, 'depth');
        $minDepthRange = count($depthValues) > 0 ? (int) min($depthValues) : 0;
        $maxDepthRange = count($depthValues) > 0 ? (int) max($depthValues) : 700;
    @endphp
    <div class="flex flex-wrap gap-4 mb-4">
        <div wire:ignore id="magnitude_filter_div" class="flex-1 min-w-[200px] @if(count($earthquakes) === 0) hidden @endif"></div>
        <div wire:ignore id="depth_filter_div" class="flex-1 min-w-[200px] @if(count($earthquakes) === 0) hidden @endif"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div wire:ignore id="scatter-chart" class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 h-80"></div>
        <div wire:ignore id="mag-dist-chart" class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 h-80"></div>
        <div wire:ignore id="depth-dist-chart" class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 h-80"></div>
        <div wire:ignore id="time-dist-chart" class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 h-80"></div>
    </div>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
        {{ __('projects.earthquake-tracker.data_source') }}
        <a
            href="https://boostr.cl/sismos"
            target="_blank"
            class="underline hover:text-blue-500"
        >
            Boostr
        </a>
    </p>

    @if (count($earthquakes) !== 0)
    @php
        $perPage = 10;
        $totalItems = count($earthquakes);
        $totalPages = max(1, (int) ceil($totalItems / $perPage));
        $offset = ($page - 1) * $perPage;
        $paginated = array_slice($earthquakes, $offset, $perPage);
        $from = $totalItems > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $totalItems);
    @endphp
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-8">
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
                    @foreach ($paginated as $eq)
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
        @if ($totalPages > 1)
        <div class="flex flex-col sm:flex-row items-center justify-between px-4 py-3 border-t border-gray-300 dark:border-gray-600 gap-2">
            <span class="text-sm text-gray-600 dark:text-gray-400">
                {{ $from }}-{{ $to }} {{ __('projects.earthquake-tracker.of') }} {{ $totalItems }}
            </span>
            <div class="flex items-center gap-1">
                <button
                    wire:click="$set('page', 1)"
                    @if($page === 1) disabled @endif
                    class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                >&laquo;</button>
                <button
                    wire:click="$set('page', {{ $page - 1 }})"
                    @if($page === 1) disabled @endif
                    class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                >&lsaquo;</button>
                @php
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);
                    if ($endPage - $startPage < 4) {
                        if ($startPage === 1) {
                            $endPage = min($totalPages, $startPage + 4);
                        } else {
                            $startPage = max(1, $endPage - 4);
                        }
                    }
                @endphp
                @if ($startPage > 1)
                    <button wire:click="$set('page', 1)" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">1</button>
                    @if ($startPage > 2) <span class="px-1 text-gray-400">...</span> @endif
                @endif
                @for ($i = $startPage; $i <= $endPage; $i++)
                    <button
                        wire:click="$set('page', {{ $i }})"
                        @if($i === $page) disabled @endif
                        class="px-2 py-1 text-sm rounded border cursor-pointer
                            @if ($i === $page)
                                bg-blue-500 text-white border-blue-500
                            @else
                                border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700
                            @endif
                        "
                    >{{ $i }}</button>
                @endfor
                @if ($endPage < $totalPages)
                    @if ($endPage < $totalPages - 1) <span class="px-1 text-gray-400">...</span> @endif
                    <button wire:click="$set('page', {{ $totalPages }})" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">{{ $totalPages }}</button>
                @endif
                <button
                    wire:click="$set('page', {{ $page + 1 }})"
                    @if($page === $totalPages) disabled @endif
                    class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                >&rsaquo;</button>
                <button
                    wire:click="$set('page', {{ $totalPages }})"
                    @if($page === $totalPages) disabled @endif
                    class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                >&raquo;</button>
            </div>
        </div>
        @endif
    </div>
    @else
        <p class="text-gray-500 dark:text-gray-400 mb-8">
            {{ __('projects.earthquake-tracker.no_earthquakes') }}
        </p>
    @endif

    <div class="mt-10 pt-8 border-t border-gray-300 dark:border-gray-600">
        <h3 class="text-xl font-bold mb-6">{{ __('projects.earthquake-tracker.use_cases_title') }}</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h4 class="font-semibold mb-2">{{ __('projects.earthquake-tracker.use_case_1_title') }}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('projects.earthquake-tracker.use_case_1_description') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h4 class="font-semibold mb-2">{{ __('projects.earthquake-tracker.use_case_2_title') }}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('projects.earthquake-tracker.use_case_2_description') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h4 class="font-semibold mb-2">{{ __('projects.earthquake-tracker.use_case_3_title') }}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('projects.earthquake-tracker.use_case_3_description') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h4 class="font-semibold mb-2">{{ __('projects.earthquake-tracker.use_case_4_title') }}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('projects.earthquake-tracker.use_case_4_description') }}</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    if (@json(count($chartData)) === 0) {
        var charts = ['scatter-chart', 'mag-dist-chart', 'depth-dist-chart', 'time-dist-chart'];
        for (var i = 0; i < charts.length; i++) {
            var el = document.getElementById(charts[i]);
            if (el) el.style.display = 'none';
        }
        var filter = document.getElementById('magnitude_filter_div');
        if (filter) filter.style.display = 'none';
        var depthFilter = document.getElementById('depth_filter_div');
        if (depthFilter) depthFilter.style.display = 'none';
    }

    var chartsReady = false;

    var scatterDashboard = null;

    google.charts.load('current', { packages: ['corechart', 'controls'] });
    google.charts.setOnLoadCallback(function () {
        chartsReady = true;
        initCharts();
    });

    function getChartData() {
        var el = document.getElementById('chart-data');
        if (!el) return null;
        return {
            scatter: JSON.parse(el.dataset.scatter || '[]'),
            magDist: JSON.parse(el.dataset.magDist || '[]'),
            depthDist: JSON.parse(el.dataset.depthDist || '[]'),
            timeDist: JSON.parse(el.dataset.timeDist || '[]'),
        };
    }

    function initCharts() {
        var d = getChartData();
        if (!d || d.scatter.length <= 1) return;
        drawScatterChart(d.scatter);
        drawMagDistChart(d.magDist);
        drawDepthDistChart(d.depthDist);
        drawTimeDistChart(d.timeDist);
    }

    function drawScatterChart(rawData) {
        var data = google.visualization.arrayToDataTable(rawData);

        data.setColumnLabel(0, '{{ __('projects.earthquake-tracker.table_labels.depth') }}');
        data.setColumnLabel(1, '{{ __('projects.earthquake-tracker.table_labels.magnitude') }}');

        data.addColumn({ type: 'string', role: 'tooltip' });
        for (var i = 0; i < data.getNumberOfRows(); i++) {
            var depth = data.getValue(i, 0);
            var magnitude = data.getValue(i, 1);
            var tooltip = '{{ __('projects.earthquake-tracker.table_labels.depth') }}: ' + depth + ' km\n' +
                          '{{ __('projects.earthquake-tracker.table_labels.magnitude') }}: ' + magnitude;
            data.setValue(i, 2, tooltip);
        }

        var options = {
            title: '{{ __('projects.earthquake-tracker.chart_title') }}',
            hAxis: { title: '{{ __('projects.earthquake-tracker.hAxis_title') }}' },
            vAxis: { title: '{{ __('projects.earthquake-tracker.vAxis_title') }}' },
            legend: 'none',
            pointSize: 6,
            colors: ['#ef4444'],
            chartArea: { left: 60, right: 20, top: 50, bottom: 60 },
        };

        if (!scatterDashboard) {
            var magnitudeControl = new google.visualization.ControlWrapper({
                controlType: 'NumberRangeFilter',
                containerId: 'magnitude_filter_div',
                options: {
                    filterColumnIndex: 1,
                    minValue: {{ $minMagRange }},
                    maxValue: {{ $maxMagRange }},
                    ui: {
                        labelStacking: 'vertical',
                        label: '{{ __('projects.earthquake-tracker.magnitude_filter') }}',
                    }
                }
            });

            var depthControl = new google.visualization.ControlWrapper({
                controlType: 'NumberRangeFilter',
                containerId: 'depth_filter_div',
                options: {
                    filterColumnIndex: 0,
                    minValue: {{ $minDepthRange }},
                    maxValue: {{ $maxDepthRange }},
                    ui: {
                        labelStacking: 'vertical',
                        label: '{{ __('projects.earthquake-tracker.depth_filter_label') }}',
                    }
                }
            });

            var chart = new google.visualization.ChartWrapper({
                chartType: 'ScatterChart',
                containerId: 'scatter-chart',
                options: options
            });

            scatterDashboard = new google.visualization.Dashboard(
                document.getElementById('scatter-chart')
            );

            scatterDashboard.bind([magnitudeControl, depthControl], chart);

            google.visualization.events.addListener(
                magnitudeControl,
                'statechange',
                function () {
                    var state = magnitudeControl.getState();
                    @this.set('minMagnitude', state.lowValue || 0);
                    @this.set('maxMagnitude', state.highValue || 10);
                    @this.loadEarthquakesFromDB();
                }
            );

            google.visualization.events.addListener(
                depthControl,
                'statechange',
                function () {
                    var state = depthControl.getState();
                    @this.set('minDepth', state.lowValue || 0);
                    @this.set('maxDepth', state.highValue || 700);
                    @this.loadEarthquakesFromDB();
                }
            );
        }

        scatterDashboard.draw(data);
    }

    function drawMagDistChart(rawData) {
        if (rawData.length <= 1) return;
        var data = google.visualization.arrayToDataTable(rawData);
        var options = {
            title: '{{ __('projects.earthquake-tracker.magnitude_distribution_title') }}',
            hAxis: { title: '{{ __('projects.earthquake-tracker.range') }}' },
            vAxis: { title: '{{ __('projects.earthquake-tracker.count') }}', minValue: 0 },
            legend: 'none',
            colors: ['#3b82f6'],
            bar: { groupWidth: '85%' },
            chartArea: { left: 50, right: 20, top: 50, bottom: 50 },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('mag-dist-chart'));
        chart.draw(data, options);
    }

    function drawDepthDistChart(rawData) {
        if (rawData.length <= 1) return;
        var data = google.visualization.arrayToDataTable(rawData);
        var options = {
            title: '{{ __('projects.earthquake-tracker.depth_distribution_title') }}',
            hAxis: { title: '{{ __('projects.earthquake-tracker.table_labels.depth') }}' },
            vAxis: { title: '{{ __('projects.earthquake-tracker.count') }}', minValue: 0 },
            legend: 'none',
            colors: ['#8b5cf6'],
            bar: { groupWidth: '85%' },
            chartArea: { left: 50, right: 20, top: 50, bottom: 50 },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('depth-dist-chart'));
        chart.draw(data, options);
    }

    function drawTimeDistChart(rawData) {
        if (rawData.length <= 1) return;
        var data = google.visualization.arrayToDataTable(rawData);
        var options = {
            title: '{{ __('projects.earthquake-tracker.time_distribution_title') }}',
            hAxis: {
                title: '{{ __('projects.earthquake-tracker.date') }}',
                slantedText: true,
                slantedTextAngle: 45,
            },
            vAxis: { title: '{{ __('projects.earthquake-tracker.count') }}', minValue: 0 },
            legend: 'none',
            colors: ['#10b981'],
            bar: { groupWidth: '70%' },
            chartArea: { left: 50, right: 20, top: 50, bottom: 70 },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('time-dist-chart'));
        chart.draw(data, options);
    }

    document.addEventListener('livewire:init', function () {
        Livewire.on('chartDataUpdated', function () {
            if (!chartsReady) return;
            var d = getChartData();
            if (!d) return;
            drawScatterChart(d.scatter);
            drawMagDistChart(d.magDist);
            drawDepthDistChart(d.depthDist);
            drawTimeDistChart(d.timeDist);
        });
    });
</script>
