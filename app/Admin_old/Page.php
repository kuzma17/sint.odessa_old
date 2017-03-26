<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 16.11.16
 * Time: 15:27
 */

use App\Page;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Page::class, function (ModelConfiguration $model) {
    // $model->setTitle('статьи')->enableAccessCheck();
    $model->setTitle('статьи');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('url'),
            AdminColumn::link('title')->setLabel('Title')
        );
        $display->paginate(10);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(

            AdminFormElement::text('title', 'Title'),
            AdminFormElement::text('url', 'url'),
            AdminFormElement::wysiwyg('content', 'текс страници'),
            AdminFormElement::text('keywords', 'keywords')
        );
        $form->getButtons()->hideSaveAndCreateButton()->hideSaveAndCloseButton();
        return $form;
    });
})
    ->addMenuPage(Page::class, 0);