<?php

namespace App\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\User;
use App\UserProfile;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class UserProfile
 *
 * @property \App\UserProfile $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Client extends Section implements Initializable
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

    public function initialize(){
        $this->addToNavigation()
            ->setIcon('fa fa-user-o')
            ->setPriority(1200)
            ->addBadge(function() {
                return UserProfile::count();
            }, ['class' => 'label-info', 'title'=>'Всего клиентов']);
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        // table-info table-primary table-responsive table-bordered table-success table-warning
        return AdminDisplay::datatables()
            ->with('user', 'type_client', 'type_payment')
            ->setOrder([[6, 'desc']]) // сортировка по номеру столбца отображаемого в админке
            ->setHtmlAttribute('class', 'table-info')
            ->setColumns([
                AdminColumn::link('user.name', 'Nic'),
                AdminColumn::link('client_name', 'Name client'),
                AdminColumn::email('user.email', 'Email')->setWidth('150px'),
                AdminColumn::image('avatar1.avatar', 'avatar'),
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

        //return AdminForm::panel()->addBody(
          //  AdminFormElement::text('user.name', 'Nic'),
          //  AdminFormElement::text('client_name', 'Name client'),
          //  AdminFormElement::text('user.email', 'Email'),
          //  AdminFormElement::password('user.password', 'Пароль')->hashWithBcrypt(),
          //  // AdminFormElement::image('avatar1.avatar', 'image'),
          //  AdminFormElement::select('type_client_id', trans('type client'))->setModelForOptions(new \App\TypeClient())->setDisplay('name'),
          //  AdminFormElement::select('type_payment_id', trans('type client'))->setModelForOptions(new \App\TypePayment())->setDisplay('name'),
          //  AdminFormElement::text('phone', 'Телефон'),
          //  AdminFormElement::text('address', 'Адрес доставки'),
          //  AdminFormElement::text('user_company', 'user_company'),
          //  AdminFormElement::text('company_full', 'Полное наименование организации'),
          //  AdminFormElement::text('edrpou', 'код ЕДРПОУ'),
          //  AdminFormElement::text('inn', 'код ИНН'),
          //  AdminFormElement::text('code_index', 'Почтовый индеч'),
          //  AdminFormElement::text('region', 'Регион'),
          //  AdminFormElement::text('area', 'Район'),
          //  AdminFormElement::text('city', 'Город'),
          //  AdminFormElement::text('street', 'Улица'),
          //  AdminFormElement::text('house', 'Номер дома'),
          //  AdminFormElement::text('house_block', 'Корпус'),
          //  AdminFormElement::text('office', 'Офис/Квартира')
        //);

        //$user_id = $this->model->find($id)->user_id;
        //$user = User::find($user_id);
        ///return view('admin.profile', ['user' => $user]);

        $formPrimary = AdminForm::form()->addElement(
            new FormElements([
                AdminFormElement::text('user.name', 'Nic'),
                AdminFormElement::text('client_name', 'Name client')->required(),
                AdminFormElement::text('user.email', 'Email')->required(),
                AdminFormElement::password('user.password', 'Пароль')->hashWithBcrypt(),
                AdminFormElement::image('avatar1.avatar', 'image')->setUploadPath(function() {return 'images/avatars';}),
                AdminFormElement::select('type_client_id', trans('type client'))->setModelForOptions(new \App\TypeClient())->setDisplay('name'),
                AdminFormElement::text('phone', 'Телефон')->required(),
                AdminFormElement::text('address', 'Адрес доставки'),
            ])
        );
        $formCompany = AdminForm::form()->addElement(
            new FormElements([
                AdminFormElement::text('user_company', 'user_company'),
                AdminFormElement::text('company_full', 'Полное наименование организации'),
                AdminFormElement::select('type_payment_id', trans('type client'))->setModelForOptions(new \App\TypePayment())->setDisplay('name'),
                AdminFormElement::text('edrpou', 'код ЕДРПОУ'),
                AdminFormElement::text('inn', 'код ИНН'),
            ])
        );

        $formLocate = AdminForm::form()->addElement(
            new FormElements([
                AdminFormElement::text('code_index', 'Почтовый индеч'),
                AdminFormElement::text('region', 'Регион'),
                AdminFormElement::text('area', 'Район'),
                AdminFormElement::text('city', 'Город'),
                AdminFormElement::text('street', 'Улица'),
                AdminFormElement::text('house', 'Номер дома'),
                AdminFormElement::text('house_block', 'Корпус'),
                AdminFormElement::text('office', 'Офис/Квартира')
            ])
        );

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($formPrimary, 'Клиент/Компания');
        $tabs->appendTab($formCompany, 'Реквизиты компании');
        $tabs->appendTab($formLocate, 'Юридический адрес');


        return $tabs;
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
        $user_id = $this->model->find($id)->user_id;
        User::destroy($user_id);
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // todo: remove if unused
    }
}
