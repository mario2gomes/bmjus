<script>
	confirm('Texto informativo');

	ESTATÍSTICAS E DASHBOARDS
</script>

<div class="row  border-bottom white-bg dashboard-header">

    <div class="col-sm-6">
        <div class="flot-chart dashboard-chart">
            <div class="flot-chart-content" id="flot-dashboard-chart"></div>
        </div>
        <div class="row text-left">
            <div class="col-xs-4">
                <div class=" m-l-md">
                <span class="h4 font-bold m-t block">$ 406,100</span>
                <small class="text-muted m-b block">Sales marketing report</small>
                </div>
            </div>
            <div class="col-xs-4">
                <span class="h4 font-bold m-t block">$ 150,401</span>
                <small class="text-muted m-b block">Annual sales revenue</small>
            </div>
            <div class="col-xs-4">
                <span class="h4 font-bold m-t block">$ 16,822</span>
                <small class="text-muted m-b block">Half-year revenue margin</small>
            </div>

        </div>
    </div>
    <div class="col-sm-3">
        <div class="statistic-box">
        <h4>
            Project Beta progress
        </h4>
        <p>
            You have two project with not compleated task.
        </p>
            <div class="row text-center">
                <div class="col-lg-6">
                    <canvas id="doughnutChart" width="200" height="200"></canvas>
                    <h5 >Maxtor</h5>
                </div>
            </div>
            <div class="m-t">
                <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
            </div>

        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

            }, 1300);


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#464f88"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = [
                {
                    value: <?php echo $criados; ?>,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "criados"
                },
                {
                    value: <?php echo $instaurados; ?>,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "instaurados"
                },
                {
                    value: <?php echo $suspensos; ?> ,
                    color: "#b5b8cf",
                    highlight: "#1ab394",
                    label: "suspensos"
                },
                {
                    value: <?php echo $aguardando_solucao; ?> ,
                    color: "#b5c7cf",
                    highlight: "#1ab394",
                    label: "aguardando solução"
                },
                {
                    value: <?php echo $em_analise; ?> ,
                    color: "#b5d9cf",
                    highlight: "#1ab394",
                    label: "em análise"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

        });
    </script>