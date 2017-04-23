<?php

namespace App\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Status
 *
 * @property \App\Status $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Status extends Section
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
    protected $title = 'Статусы заказа';

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
                AdminColumn::link('id', 'id')->setWidth('50px'),
                AdminColumn::link('name', 'Статус')
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
                AdminFormElement::text('id', 'id')->required(),
                AdminFormElement::text('name', 'Статус')->required()
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
