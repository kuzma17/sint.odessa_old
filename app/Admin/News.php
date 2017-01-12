<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 16.11.16
 * Time: 14:44
 */

use App\News;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(News::class, function (ModelConfiguration $model) {
    //$model->enableAccessCheck();
    //$model->setTitle('статьи')->enableAccessCheck();
    $model->setTitle('Новости');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('title')->setLabel('Title'),
            AdminColumn::datetime("published_at", "Дата<br>публикации")->setFormat('d.m.Y'),
            AdminColumnEditable::checkbox('published')->setLabel('Published'),
            AdminColumn::custom('published')->setLabel('published')->setCallback(function($val){
                return $val->published ? '<i class="fa fa-check-square-o" aria-hidden="true"></i>' : '<i class="fa fa-square-o" aria-hidden="true"></i>';
            })
        );
        $display->paginate(10);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Title')->required()->unique(),
            AdminFormElement::wysiwyg('content', 'текс статьи'),
            //AdminFormElement::checkbox('published', 'published'),
            AdminFormElement::columns()->addColumn(function (){ return[
                AdminFormElement::select('published', 'published',['0'=>'off', '1'=>'on'])->required(),
            ];}),

            // AdminFormElement::select('userInfo.marital_id', trans('labels.user.info.marital'))->setModelForOptions(new RefMarital)->setDisplay('name'),
            //AdminFormElement::radio('userInfo.gender', trans('labels.user.info.gender'))->setOptions(array('0' => trans('labels.user.info.gender_woman'), '1' => trans('labels.user.info.gender_man'))),
            AdminFormElement::date('published_at', 'published_at')
        );
        return $form;
    });
})
    ->addMenuPage(News::class, 0);