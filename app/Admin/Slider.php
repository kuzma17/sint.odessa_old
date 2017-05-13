<?php

namespace App\Admin;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Slider
 *
 * @property \App\Slider $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Slider extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Слайдер';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return  AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
                AdminColumnEditable::checkbox('active')->setLabel('active'),
                AdminColumn::link('weight')->setLabel('weight'),
                AdminColumn::image('image', 'image')
            );
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()
            ->setHtmlAttribute('enctype', 'multipart/form-data')
            ->addBody(
                AdminFormElement::select('active', 'active',['0'=>'off', '1'=>'on'])->required(),
                AdminFormElement::text('weight', 'вес'),
                AdminFormElement::image('image', 'image')->setUploadPath(function() {return 'images/slider';}),
                AdminFormElement::text('slogan', 'слоган')
            );
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // todo: remove if unused
    }
}
