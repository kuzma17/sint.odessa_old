<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 08.10.16
 * Time: 12:22
 */

use App\Settings;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Settings::class, function (ModelConfiguration $model) {
    $model->setTitle('Settings');
    // Display
    $model->onDisplay(function () {
        $settings = Settings::first();
        return view('admin/settings', ['settings' => $settings]);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()
            ->setHtmlAttribute('enctype', 'multipart/form-data')
            ->addBody(
                AdminFormElement::text('title', 'title'),
                AdminFormElement::text('description', 'description'),
                AdminFormElement::text('keywords', 'keywords'),
                AdminFormElement::text('count_news', 'количество новостей на странице')
            );
        $form->getButtons()->hideSaveAndCreateButton()->hideSaveAndCloseButton();
        return $form;
    })->disableDeleting();
})
    ->addMenuPage(Settings::class, 0);