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
 * Class UserProfile
 *
 * @property \App\UserProfile $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Client extends Section
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
    protected $title = 'Клиенты';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        // table-info table-primary table-responsive table-bordered table-success table-warning
        return AdminDisplay::datatables()
            ->with('user', 'type_client', 'type_payment')
            ->setHtmlAttribute('class', 'table-info')
            ->setColumns([
                AdminColumn::link('user.name', 'Nic'),
                AdminColumn::link('client_name', 'Name client'),
                AdminColumn::email('user.email', 'Email')->setWidth('150px'),
                AdminColumn::link('type_client.name', 'type client'),
                AdminColumn::link('type_payment.name', 'type payment'),
                AdminColumn::link('phone', 'Phone'),
                AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
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
            AdminFormElement::text('client_name', 'Name client'),
            AdminFormElement::select('type_client_id', trans('type client'))->setModelForOptions(new \App\TypeClient())->setDisplay('name'),
            AdminFormElement::select('type_payment_id', trans('type client'))->setModelForOptions(new \App\TypePayment())->setDisplay('name'),
            AdminFormElement::text('phone', 'Phone'),
            AdminFormElement::text('address', 'Адрес доставки'),
            AdminFormElement::text('phone', 'Phone'),
            AdminFormElement::text('user_company', 'user_company'),
            AdminFormElement::text('company_full', 'Полное наименование организации'),
            AdminFormElement::text('edrpou', 'код ЕДРПОУ'),
            AdminFormElement::text('inn', 'код ИНН'),
            AdminFormElement::text('code_index', 'Почтовый индеч'),
            AdminFormElement::text('region', 'Регион'),
            AdminFormElement::text('area', 'Район'),
            AdminFormElement::text('city', 'Город'),
            AdminFormElement::text('street', 'Улица'),
            AdminFormElement::text('house', 'Номер дома'),
            AdminFormElement::text('house_block', 'Корпус'),
            AdminFormElement::text('office', 'Офис/Квартира')
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