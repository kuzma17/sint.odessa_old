<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;
use Tracker;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('Description...');

            $content->row(function ($row) {
                $row->column(3, new InfoBox('Новых клиентов', 'users', 'aqua', '/admin/users', \App\Http\Controllers\UserProfileController::count_users()));
                $row->column(3, new InfoBox('Новых заказов', 'shopping-cart', 'green', '/admin/orders',  \App\Http\Controllers\OrderController::count_new_orders()));
                $row->column(3, new InfoBox('Всего клиентов', 'users', 'yellow', '/admin/users', \App\User::count() ));
                $row->column(3, new InfoBox('Всего заказов', 'shopping-cart', 'red', '/admin/orders', \App\Order::count()));
            });

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {

                    $sessions = Tracker::sessions(60 * 24 * 30);
                    $views = [];
                    foreach ($sessions as $session) {
                        $key = $session->updated_at->format("d.m");
                        if(array_key_exists($key, $views)){
                            $views[$key][1] = $views[$key][1] + 1;
                        }else{
                            $views[$key] = [$key, 1];
                        }
                    }

                    asort($views);

                    $arr_views = [];
                    $arr_date = [];
                    foreach ($views  as $view){
                        $arr_views[] = $view[0];
                        $arr_date[] = $view[1];
                    }
                    $arr = [
                        'dataArray' => json_encode( $arr_date, JSON_UNESCAPED_UNICODE),
                        'dateArray' => json_encode( $arr_views, JSON_UNESCAPED_UNICODE),
                    ];

                   $column->append((new Box('Визиты за последние 30 дней', new Line($arr)))->removable()->collapsable()->style('danger'));

                    $arr_path = [];
                    foreach (\PragmaRX\Tracker\Vendor\Laravel\Models\Path::all() as $path){
                        if(strstr($path->path, '_') || strstr($path->path, 'admin')  || strstr($path->path, 'order-modal')){
                            continue;
                        }
                        $count_path = \PragmaRX\Tracker\Vendor\Laravel\Models\Log::where('path_id', $path->id)->count();
                        if($count_path > 10){
                            $arr_path[] = [$path->path, $count_path];
                        }
                    }

                    $column->append((new Box('Наиболее посещаемые страницы', new Pie($arr_path)))->removable()->collapsable()->style('info'));

                });

                $row->column(6, function (Column $column) {

                    $sessions = Tracker::sessions(60 * 24 * 30);
                    $browsers = [];
                    foreach ($sessions as $session) {
                        if(array_key_exists($session->agent->browser, $browsers)){
                            $browsers[$session->agent->browser][1] = $browsers[$session->agent->browser][1] + 1;
                        }else{
                            $browsers[$session->agent->browser] = [$session->agent->browser, 1];
                        }
                    }
                    $arr_browsers = [];
                    foreach ($browsers  as $browser){
                        $arr_browsers[] = [$browser[0], $browser[1]];
                    }

                    $doughnut = new Doughnut($arr_browsers);
                    $column->append((new Box('Браузеры', $doughnut))->removable()->collapsable()->style('info'));



                    $orders = \App\Http\Controllers\OrderController::count_day_orders();

                   // $column->append((new Box('Заказы за 30 дней', new Line($orders)))->removable()->collapsable()->style('danger'));

                    $column->append((new Box('Заказы за 30 дней', new Bar($orders['dateArray'], [['bar', $orders['dataArray']]])))->removable()->collapsable()->style('success'));


                });

            });

            $headers = ['Id', 'Email', 'Name', 'Company', 'Last Login', 'Status'];
            $rows = [
                [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica', '1997-08-13 13:59:21', 'open'],
                [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar', '1988-07-19 03:19:08', 'blocked'],
                [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC', '1978-06-19 11:12:57', 'blocked'],
                [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor', '1988-09-07 23:57:45', 'open'],
                [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Braun Ltd', '2013-10-16 10:00:01', 'open'],
            ];

            $content->row((new Box('Table', new Table($headers, $rows)))->style('info')->solid());
        });
    }
}
