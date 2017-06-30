<?php

namespace App\Admin\Extensions;

use App\Order;
use App\User;

class BadgeMenu
{
    public static function countUser(){
        $countUser = User::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/users"]');
            obj.append( '<span class="label label-success" style="position:absolute; right: 10px" >$countUser</span>' );
EOT;
        return $script;
    }

    public static function countOrder(){
        $countOrder = Order::where('type_order_id', 1)->count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/orders"]');
            obj.append( '<span class="label label-danger" style="position:absolute; right: 10px" >$countOrder</span>' );
EOT;
        return $script;
    }

    public static function countRepair(){
        $countRepair = Order::where('type_order_id', 2)->count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/orderrepairs"]');
            obj.append( '<span class="label label-success" style="position:absolute; right: 10px" >$countRepair</span>' );
EOT;
        return $script;
    }
    
}