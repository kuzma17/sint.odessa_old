<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 08.10.16
 * Time: 12:22
 */

use App\Banner;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Banner::class, function (ModelConfiguration $model) {
    $model->setTitle('Slider');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('title')->setLabel('title')
        );
        $display->paginate(10);
        return $display;
    })->disableDeleting()->disableCreating();
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()
            ->setHtmlAttribute('enctype', 'multipart/form-data')
            ->addBody(
                AdminFormElement::text('title', 'title'),
                AdminFormElement::textarea('banner', 'banner')
            );
        return $form;
    });
})
    ->addMenuPage(Banner::class, 0);