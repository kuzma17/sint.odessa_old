<?php

$metrika1 = \YandexMetrika::getVisitsViewsUsers()->adapt();
$chart1 = $metrika1->adaptData;

$metrika2 = \YandexMetrika::getTopPageViews()->adapt();
$chart2 = $metrika2->adaptData;

$metrika3 = \YandexMetrika::getVisitsUsersSearchEngine()->adapt();
$chart3 = $metrika3->adaptData;

$orders = \App\Http\Controllers\OrderController::count_day_orders();

?>
<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-green">
            <i class="fa fa-cart-plus" aria-hidden="true" ></i>
        </span>
        <div class="info-box-content">
            <span class="info-box-text">Всего заказов</span>
            <span class="info-box-number">{{ \App\Order::count() }}</span>
        </div>
    </div>
    </div>
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
    <span class="info-box-icon bg-red">
        <i class="fa fa-cart-plus" aria-hidden="true"></i>
    </span>
    <div class="info-box-content">
        <span class="info-box-text">Новых заказов<br>(не обработанных)</span>
        <span class="info-box-number">{{ \App\Http\Controllers\OrderController::count_new_orders() }}</span>
    </div>
</div>
    </div>
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
    <span class="info-box-icon bg-aqua">
        <i class="fa fa-user-o" aria-hidden="true"></i>
    </span>
    <div class="info-box-content">
        <span class="info-box-text">Всего клиентов</span>
        <span class="info-box-number">{{ \App\UserProfile::count() }}</span>
    </div>
</div>
    </div>
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
    <span class="info-box-icon bg-yellow">
        <i class="fa fa-user-o" aria-hidden="true"></i>
    </span>
    <div class="info-box-content">
        <span class="info-box-text">Новых клинтов</span>
        <span class="info-box-number">{{ \App\Http\Controllers\UserProfileController::count_users() }}</span>
    </div>
</div>
    </div>
    <!-- /.info-box -->
<div style="clear: both"></div>

<div class="col-md-12 col-lg-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Заказы за последние 30 дней</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-sm-12 col-md-12 ">
                    <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" style="">
                                <canvas id="Chart11" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
</div>

<div class="col-md-12 col-lg-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Визиты с учетом поисковых систем</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-md-10 col-sm-10">
                    <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" style="padding: 11%">
                                <canvas id="Chart2" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div style="clear: both"></div>

<div class="col-md-12 col-lg-6">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Посетителей за последние 30 дней</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers">
                                <canvas id="Chart1" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
</div>

<div class="col-md-12 col-lg-6">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Самые просматриваемые страницы</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" >
                                <canvas id="Chart3" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
</div>

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>

    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
    };

    var color = Chart.helpers.color;
    var ctx = document.getElementById("Chart1");
    var data1 = {
        labels: {!! $chart1['dateArray'] !!},
        datasets: [{
            label: "Визиты",
            borderColor: chartColors.green,
            backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
            data: {!! $chart1['dataVisitArray'] !!},

        },{
            label: "Просмотры",
            borderColor: chartColors.blue,
            backgroundColor: color(chartColors.blue).alpha(0.2).rgbString(),
            data: {!! $chart1['dataViewArray'] !!},
        },{
            label: "Посетители",
            borderColor: chartColors.red,
            backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
            data: {!! $chart1['dataUserArray'] !!},
            fill: false,
        }]
    };
    var Chart1 = new Chart(ctx, {
        type: 'line',
        data: data1,
        options: {
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
                    chartColors.red,
                    chartColors.orange,
                    chartColors.yellow,
                    chartColors.green,
                    chartColors.blue,
                    chartColors.purple,
                    chartColors.grey,
                    chartColors.red,
                    chartColors.orange,
                    chartColors.yellow,
                    chartColors.green,
                    chartColors.blue,
                    chartColors.purple,
                    chartColors.grey,
                ]
            }]
    };
    var Chart2 = new Chart(ctx2, {
        type: 'pie',
        data: data2,
        options: {
            legend: {
                position: 'left'
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
                    chartColors.red,
                    chartColors.orange,
                    chartColors.yellow,
                    chartColors.green,
                    chartColors.blue,
                    chartColors.purple,
                    chartColors.grey,
                    chartColors.red,
                    chartColors.orange,
                    chartColors.yellow,
                    chartColors.green,
                    chartColors.blue,
                    chartColors.purple,
                    chartColors.grey,
                ]
            }]
    };
    var Chart3 = new Chart(ctx3, {
        type: 'bar',
        data: data3,
        options: {
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
            label: "Заказы",
            borderColor: chartColors.red,
            //backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
            data: {!! $orders['dataArray'] !!},
            fill: false,
        }]
    };
    var Chart11 = new Chart(ctx, {
        type: 'line',
        data: data11,
        options: {
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