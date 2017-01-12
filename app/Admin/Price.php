<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 08.10.16
 * Time: 12:22
 */

use App\Price;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Price::class, function (ModelConfiguration $model) {
    $model->setTitle('Price');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('title', 'Наименование'),
            AdminColumn::link('price', 'Цена'),
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
                AdminFormElement::text('title', 'Наименование'),
                AdminFormElement::text('price', 'Цена'),
                AdminFormElement::columns()->addColumn(function (){ return[
                    AdminFormElement::select('active', 'active',['0'=>'off', '1'=>'on'])->required(),
                ];})
            );
        $form->getButtons()->hideSaveAndCreateButton()->hideSaveAndCloseButton();
        return $form;
    });
})
    ->addMenuPage(Price::class, 0);