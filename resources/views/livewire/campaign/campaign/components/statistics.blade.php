<div>
    <div class="flex justify-between items-center mb-7">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Estadisticas de la campaña</h1>
        <div class="flex items-center space-x-2">
        </div>
    </div>

    <div class="w-full grid grid-cols-2 gap-4 justify-center items-center">
        @if ($impressions != null)
            <div id="impressions" class="w-full h-auto"> </div>
        @endif
        @if ($clicks != null)
            <div id="clicks" class="w-full h-auto"> </div>
        @endif
    </div>
    @if ($impressions == null && $clicks == null)
        <div class="w-full h-full flex justify-center items-center">
            <p class="text-gray-500 dark:text-gray-400">
                Necesitas guardar la Configuracion Meta para poder usar esta funcionalidad
            </p>
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var impressions = @json($impressions);
        var options = {
            series: [{
                name: "Alcance de la campaña",
                data: impressions['data']
            }],
            chart: {
                type: 'area',
                height: 345,
                zoom: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Grafica del alcance de la campaña',
                align: 'left'
            },
            subtitle: {
                text: 'En el tiempo',
                align: 'left'
            },
            labels: impressions['label'],
            xaxis: {},
            yaxis: {
                opposite: true
            },
            legend: {
                horizontalAlign: 'left'
            }
        };

        var impressions = new ApexCharts(document.querySelector("#impressions"), options);
        impressions.render();
    </script>
    <script>
        var clicks = @json($clicks);
        var options = {
            title: {
                text: 'Grafica de cantidad de clicks',
                align: 'left'
            },
            subtitle: {
                text: 'En base a las publicaciones',
                align: 'left'
            },
            series: [{
                name: 'Cantidad de clicks',
                data: clicks['data']
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 0
            },
            grid: {
                row: {
                    colors: ['#fff', '#f2f2f2']
                }
            },
            xaxis: {
                labels: {
                    rotate: -45,
                },
                categories: clicks['label'],
                tickPlacement: 'on'
            },
            yaxis: {},
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: "horizontal",
                    shadeIntensity: 0.25,
                    gradientToColors: undefined,
                    inverseColors: true,
                    opacityFrom: 0.85,
                    opacityTo: 0.85,
                    stops: [50, 0, 100]
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#clicks"), options);
        chart.render();
    </script>
</div>
