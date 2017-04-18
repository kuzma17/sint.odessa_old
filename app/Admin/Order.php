<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 16.11.16
 * Time: 14:44
 */

use App\Order;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Order::class, function (ModelConfiguration $model) {

    $model->setTitle('Orders');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('type_order.name')->setLabel('Тип услуги'),
            AdminColumn::link('client_name')->setLabel('Клиент'),
            AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
            AdminColumn::link('status.name', 'Статус')

        );
        $display->setApply(function ($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->paginate(10);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('type_order.name')->setLabel('Тип услуги'),
            AdminColumn::link('client_name')->setLabel('Клиент'),
            AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
            AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
            //AdminFormElement::wysiwyg('content', 'текс статьи'),
            //AdminFormElement::checkbox('published', 'published'),
            //AdminFormElement::columns()->addColumn(function (){ return[
            //AdminFormElement::select('published', 'published',['0'=>'off', '1'=>'on'])->required(),
            //];}),

            // AdminFormElement::select('userInfo.marital_id', trans('labels.user.info.marital'))->setModelForOptions(new RefMarital)->setDisplay('name'),
            //AdminFormElement::radio('userInfo.gender', trans('labels.user.info.gender'))->setOptions(array('0' => trans('labels.user.info.gender_woman'), '1' => trans('labels.user.info.gender_man'))),
            AdminFormElement::select('status_id', trans('Статус'))->setModelForOptions(new \App\Status())->setDisplay('name')
        );
        return $form;
    });
})
    ->addMenuPage(Order::class, 0);