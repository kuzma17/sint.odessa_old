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
 * Class Menu
 *
 * @property \App\Menu $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Menu extends Section
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
    protected $title = 'Меню';

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
                AdminColumn::link('url', 'url'),
                AdminColumn::link('title', 'title'),
                AdminColumn::link('weight', 'вес'),
                AdminColumnEditable::checkbox('active')->setLabel('active')
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
            ->addBody(
                AdminFormElement::text('url', 'url')->required(),
                AdminFormElement::text('title', 'title')->required(),
                AdminFormElement::text('weight', 'вес'),
                AdminFormElement::select('active', 'active',['0'=>'off', '1'=>'on'])->required()
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
