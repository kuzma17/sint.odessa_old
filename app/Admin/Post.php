<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 16.11.16
 * Time: 15:27
 */

use App\Post;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Post::class, function (ModelConfiguration $model) {
   // $model->setTitle('статьи')->enableAccessCheck();
    $model->setTitle('статьи');
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

            AdminFormElement::date('published_at', 'published_at')
        );
        return $form;
    });
})
    ->addMenuPage(Post::class, 0)
    ->setIcon('fa fa-bank');