<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 08.10.16
 * Time: 12:22
 */

use App\Slider;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Slider::class, function (ModelConfiguration $model) {
    $model->setTitle('Slider');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumnEditable::checkbox('active')->setLabel('active'),
            AdminColumn::link('weight')->setLabel('weight'),
            AdminColumn::image('image', 'image')
        );
        $display->paginate(10);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()
            ->setHtmlAttribute('enctype', 'multipart/form-data')
            ->addBody(
               // AdminFormElement::columns()->addColumn(function (){ return[
                    AdminFormElement::select('active', 'active',['0'=>'off', '1'=>'on'])->required(),
                //];}),
                AdminFormElement::text('weight', 'weight'),
                AdminFormElement::image('image', 'image')->setUploadPath(function() {return 'images/slider';}),
                AdminFormElement::text('slogan', 'slogan')
            );
        return $form;
    });
})
    ->addMenuPage(Slider::class, 0);