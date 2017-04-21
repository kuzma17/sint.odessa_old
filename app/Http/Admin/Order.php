<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Order
 *
 * @property \App\Order $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Order extends Section
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
    protected $title = 'ORDERS';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->with('type_order')
            ->setHtmlAttribute('class', 'table-success')
            ->setColumns([
                AdminColumn::link('id', '№'),
                AdminColumn::link('type_order.name', 'Тип услуги')->setWidth('150px'),
                AdminColumn::link('client_name', 'Клиент'),
                AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
                AdminColumn::link('status.name', 'Статус'),
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody(
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('type_order.name')->setLabel('Тип услуги'),
            AdminColumn::link('client_name')->setLabel('Клиент'),
            AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
            AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
            //AdminFormElement::wysiwyg('content', 'текс статьи'),
            //AdminFormElement::checkbox('published', 'published'),
            //AdminFormElement::columns()->addColumn(function (){ return[
            //AdminFormElement::select('published', 'published',['0'=>'off', '1'=>'on'])->required(),
            //];}),

            // AdminFormElement::select('userInfo.marital_id', trans('labels.user.info.marital'))->setModelForOptions(new RefMarital)->setDisplay('name'),
            //AdminFormElement::radio('userInfo.gender', trans('labels.user.info.gender'))->setOptions(array('0' => trans('labels.user.info.gender_woman'), '1' => trans('labels.user.info.gender_man'))),
            AdminFormElement::select('status_id', trans('Статус'))->setModelForOptions(new \App\Status())->setDisplay('name')
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
