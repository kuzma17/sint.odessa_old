<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 08.10.16
 * Time: 12:22
 */

use App\Stock;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Stock::class, function (ModelConfiguration $model) {
    $model->setTitle('Акции');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('title', 'title'),
            AdminColumn::image('banner', 'banner'),
            AdminColumn::datetime('from', 'from'),
            AdminColumn::datetime('to', 'to'),
            AdminColumnEditable::checkbox('active')->setLabel('active')
        );
        $display->paginate(10);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()
            ->setHtmlAttribute('enctype', 'multipart/form-data')
            ->addBody(
                AdminFormElement::text('title', 'title'),
                AdminFormElement::image('banner', 'banner')->setUploadPath(function() {return 'images/banners';}),
                AdminFormElement::wysiwyg('content', 'content'),
                //AdminFormElement::custom()->setDisplay(view('admin/editor')),
                //AdminFormElement::custom()->setDisplay(function (\Illuminate\Database\Eloquent\Model $model){ return view('admin/editor',['text'=>$model]);}),
                AdminFormElement::date('from', 'from'),
                AdminFormElement::date('to', 'to'),
                AdminFormElement::columns()->addColumn(function (){ return[
                    AdminFormElement::select('active', 'active',['0'=>'off', '1'=>'on'])->required(),
                ];})
            );
        return $form;
    });
})
    ->addMenuPage(Stock::class, 0);
