<?php

namespace App\Admin\Extensions;

use App\Order;
use App\User;

class BadgeMenu
{

    public static function countItem(){
        $countOrder = Order::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/orders"]');
            obj.append( '<span class="label label-danger" style="position:absolute; right: 10px" >$countOrder</span>' );
EOT;
        return $script;
    }

    public static function countBrand(){
        $countBrand = User::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/users"]');
            obj.append( '<span class="label label-success" style="position:absolute; right: 10px" >$countBrand</span>' );
EOT;
        return $script;
    }
    
}