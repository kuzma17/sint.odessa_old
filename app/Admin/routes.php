<?php

//Route::get('', ['as' => 'admin.dashboard', function () {
//	$content = 'Define your dashboard here.';
//	return AdminSection::view($content, 'Dashboard');
//}]);

//Route::get('', ['as' => 'admin.dashboard', 'uses'=>'App\Admin\DashboardController@info']);

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = view('admin.dashboard_info');
	return AdminSection::view($content, 'Dashboard');
}]);

Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Define your information here.';
	return AdminSection::view($content, 'Information');
}]);