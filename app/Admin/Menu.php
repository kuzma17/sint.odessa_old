<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 08.10.16
 * Time: 12:22
 */

use App\Menu;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Menu::class, function (ModelConfiguration $model) {
    $model->setTitle('Slider');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('url', 'url'),
            AdminColumn::link('title', 'title'),
            AdminColumn::link('weight')->setLabel('weight'),
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
                AdminFormElement::text('url', 'url'),
                AdminFormElement::text('title', 'title'),
                AdminFormElement::text('weight', 'weight'),
                AdminFormElement::columns()->addColumn(function (){ return[
                    AdminFormElement::select('active', 'active',['0'=>'off', '1'=>'on'])->required(),
                ];})
            );
        return $form;
    });
})
    ->addMenuPage(Menu::class, 0);