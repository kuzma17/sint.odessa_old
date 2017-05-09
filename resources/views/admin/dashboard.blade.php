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
                    <div id="world-map-markers" style="height: 1500px;">
                        <div class="jvectormap-container" style="width: 100%; height: 100%; position: relative; overflow: hidden; background-color: transparent;">

                            <p>Всего клиентов: <span class="badge alert-info">{{ \App\UserProfile::count() }}</span></p>
                            <p>Всего заказов: <span class="badge alert-success">{{ \App\Order::count() }}</p>
                            <p>Новых клиентов: <span class="badge alert-info">{{ \App\Http\Controllers\UserProfileController::count_users() }}</span></p>
                            <p>Новых заказов: <span class="badge alert-success">{{ \App\Http\Controllers\OrderController::count_orders() }}</span></p>

                            <?php
                            $metrika1 = \YandexMetrika::getVisitsViewsUsers()->adapt();
                            $chart1 = $metrika1->adaptData;

                            $metrika2 = \YandexMetrika::getTopPageViews()->adapt();
                            $chart2 = $metrika2->adaptData;

                            $metrika3 = \YandexMetrika::getVisitsUsersSearchEngine()->adapt();
                            $chart3 = $metrika3->adaptData;

                            $orders = \App\Http\Controllers\OrderController::count_day_orders();

                            ?>
                            <div style="width:600px; float: left">
                                <canvas id="Chart11" ></canvas>
                            </div>

                            <hr>
                            <div style="width:600px; float: left">
                                <canvas id="Chart1" ></canvas>
                            </div>

                            <div style="width:270px;float: left">
                                <canvas id="Chart2" ></canvas>
                            </div>
                            <div style="clear: both"></div>

                            <div style="width:600px;float: left">
                                <canvas id="Chart3" ></canvas>
                            </div>

                            <script src="{{ asset('js/Chart.min.js') }}"></script>

                            <script>

                                var ctx = document.getElementById("Chart1");
                                var data1 = {
                                    labels: {!! $chart1['dateArray'] !!},
                                    datasets: [{
                                        label: "Визиты",
                                        backgroundColor: "#00ff00",
                                        borderColor: "#00ff00",
                                        data: {!! $chart1['dataVisitArray'] !!},
                                        fill: false,
                                    },{
                                        label: "Просмотры",
                                        backgroundColor: "#36A2EB",
                                        borderColor: "#36A2EB",
                                        data: {!! $chart1['dataViewArray'] !!},
                                        fill: false,
                                    },{
                                        label: "Посетители",
                                        backgroundColor: "#FF6384",
                                        borderColor: "#FF6384",
                                        data: {!! $chart1['dataUserArray'] !!},
                                        fill: false,
                                    }]
                                };
                                var Chart1 = new Chart(ctx, {
                                    type: 'line',
                                    data: data1,
                                    options: {
                                        title: {
                                            display: true,
                                            text: 'Активность посетителей за последние 30 дней'
                                        },
                                        scales: {
                                            xAxes: [{
                                                stacked: true
                                            }],
                                            yAxes: [{
                                                stacked: true
                                            }]
                                        }
                                    }
                                });

                                var ctx2 = document.getElementById("Chart2");
                                var data2 = {
                                    labels: {!! $chart3['labelArray'] !!},
                                    datasets: [
                                        {
                                            data: {!! $chart3['dataArray'] !!},
                                            backgroundColor: [
                                                "#FF6384",
                                                "#36A2EB",
                                                "#FFCE56",
                                                "#ff9933",
                                                    "#0000ff",
                                                    "#00ff00",
                                                    "#ffff00",
                                                    "#00ccff",
                                                    "#ff0000",
                                                    "#ffbf00"
                                            ],
                                            hoverBackgroundColor: [
                                                "#FF6384",
                                                "#36A2EB",
                                                "#FFCE56"
                                            ]
                                        }]
                                };
                                var Chart2 = new Chart(ctx2, {
                                    type: 'pie',
                                    data: data2,
                                    options: {
                                        title: {
                                            display: true,
                                            text: 'Количество визитов с учетом поисковых систем'
                                        },

                                    }
                                });

                                var ctx3 = document.getElementById("Chart3");
                                var data3 = {
                                    labels: {!! $chart2['labelArray'] !!},
                                    datasets: [
                                        {
                                            label:'home',
                                            data: {!! $chart2['dataArray'] !!},
                                            backgroundColor: [
                                                "#FF6384",
                                                "#36A2EB",
                                                "#FFCE56",
                                                "#ff9933",
                                                "#0000ff",
                                                "#00ff00",
                                                "#ffff00",
                                                "#00ccff",
                                                "#ff0000",
                                                "#ffbf00"
                                            ],
                                            hoverBackgroundColor: [
                                                "#FF6384",
                                                "#36A2EB",
                                                "#FFCE56"
                                            ]
                                        }]
                                };
                                var Chart3 = new Chart(ctx3, {
                                    type: 'bar',
                                    data: data3,
                                    options: {
                                        title: {
                                            display: true,
                                            text: 'Самые просматриваемые страницы'
                                        },
                                        scales: {
                                            xAxes: [{
                                                stacked: true
                                            }],
                                            yAxes: [{
                                                stacked: true
                                            }]
                                        }
                                    }
                                });

                                var ctx = document.getElementById("Chart11");
                                var data11 = {
                                    labels: {!! $orders['dateArray'] !!},
                                    datasets: [{
                                        label: "Заказыы",
                                        backgroundColor: "#FF6384",
                                        borderColor: "#FF6384",
                                        data: {!! $orders['dataArray'] !!},
                                        fill: false,
                                    }]
                                };
                                var Chart11 = new Chart(ctx, {
                                    type: 'line',
                                    data: data11,
                                    options: {
                                        title: {
                                            display: true,
                                            text: 'Количестао заказов за последние 30 дней'
                                        },
                                        scales: {
                                            xAxes: [{
                                                stacked: true
                                            }],
                                            yAxes: [{
                                                stacked: true
                                            }]
                                        }
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