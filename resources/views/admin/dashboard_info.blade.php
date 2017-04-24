<?php

?>
<!-- MAP & BOX PANE -->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Visitors Report</h3>

    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div class="pad">
                    <!-- Map will be created here -->
                    <div id="world-map-markers" style="height: 1000px;">
                        <div class="jvectormap-container" style="width: 100%; height: 100%; position: relative; overflow: hidden; background-color: transparent;">


                            <p>Всего клиентов: {{ \App\UserProfile::count() }}</p>
                            <p>Всего заказов: {{ \App\Order::count() }}</p>
                            <?php $this_date = '2017-03-31 20:11:11'; ?>
                            <p>Новых клиентов: {{ \App\UserProfile::where('created_at', '>', $this_date)->count() }}</p>
                            <p>Новых заказов: {{ \App\Order::where('created_at', '>', $this_date)->count() }}</p>


                            <?php

                            $metrika = \YandexMetrika::getVisitsViewsUsers()->adapt();
                            $chart1 = $metrika->adaptData;

                                var_dump($chart1);
                                //echo $chart1;

                            ?>
                            <div id="chart1" width="200" height="200">132</div>
                            <hr>
                            <canvas id="myChart" style="width: 400px; height: 100px"></canvas>
                            <hr>
                            <canvas id="myChart1" style="width: 400px; height: 100px"></canvas>
                            <hr>
                            <canvas id="myChart2" style="width: 400px; height: 100px"></canvas>
                            <script src="{{ asset('js/Chart.min.js') }}"></script>

                            <script>

                                //doc: http://www.chartjs.org/docs/
                                var ctx = document.getElementById("myChart");
                                var myChart = new Chart(ctx, {
                                    type: 'line',
                                    options: {
                                        title: {
                                            display: true,
                                            text: 'Активность посетителей за последние 30 дней'
                                        }
                                    },
                                    data: {
                                        labels: {!! $chart1['dateArray'] !!},
                                        datasets: {!! $chart1['dataArray'] !!}


                                    }

                                });

                                var ctx1 = document.getElementById("myChart1");
                                var myChart = new Chart(ctx1, {
                                    type: 'bar',
                                    data: {
                                        labels: {!! $chart1['dateArray'] !!},
                                        datasets: {!! $chart1['dataArray'] !!}
                                    }

                                });

                                var ctx2 = document.getElementById("myChart2");
                                var myChart = new Chart(ctx2, {
                                    type: 'pie',
                                    data: {
                                        labels: {!! $chart1['dateArray'] !!},
                                        datasets: {!! $chart1['dataArray'] !!}
                                    }

                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-4">
                <div class="pad box-pane-right bg-green" style="min-height: 280px">
                    <div class="description-block margin-bottom">
                        <div class="sparkbar pad" data-color="#fff">
                            <canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                        <h5 class="description-header">8390</h5>
                        <span class="description-text">Visits</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block margin-bottom">
                        <div class="sparkbar pad" data-color="#fff">
                            <canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                        <h5 class="description-header">30%</h5>
                        <span class="description-text">Referrals</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block">
                        <div class="sparkbar pad" data-color="#fff">
                            <canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                        <h5 class="description-header">70%</h5>
                        <span class="description-text">Organic</span>
                    </div>
                    <!-- /.description-block -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
</div>