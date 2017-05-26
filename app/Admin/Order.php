<?php

namespace App\Admin;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Http\Controllers\OrderController;
use App\Notifications\StatusOrder;
use App\Status;
use App\StatusRepair;
use App\TypePayment;
use App\User;
use App\UserConsent;
use App\UserProfile;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

/**
 * Class Order
 *
 * @property \App\Order $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Order extends Section implements Initializable
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
    protected $title = 'Заказы';

    /**
     * @var string
     */
    protected $alias;

    protected $status; // status order

    protected $status_class = ["1"=>"label label-danger", "2"=>"label label-warning", "3"=>"label label-success", "4"=>"label label-primary"];


    public function initialize(){
        $this->addToNavigation()
            ->setIcon('fa fa-cart-plus')
            ->setPriority(1300)
            ->addBadge(function() {
                return OrderController::count_new_orders();
            }, ['class' => 'label-danger',  'title'=>'Не обработанных заказов'])
            ->addBadge(function() {
            return \App\Order::count();
        }, ['class' => 'label-success', 'title'=>'Всего заказов']);

        $this->updated(function($config, Model $model){
            $status = $model->status_id;
            if($status != $this->status) {
                $status_name = Status::find($status)->name;
                $model->notify(new StatusOrder($status_name));
            }
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        return AdminDisplay::datatables()
            ->with('type_order')
            ->setOrder([[3, 'desc']]) // сортировка по номеру столбца отображаемого в админке
            ->setHtmlAttribute('class', 'table-success')
            ->setColumns([
                AdminColumn::link('id', '№'),
                AdminColumn::link('type_order.name', 'Тип услуги')->setWidth('350px'),
                AdminColumn::link('client_name', 'Клиент'),
                AdminColumn::datetime("created_at", "Дата")->setFormat('d.m.Y'),
                AdminColumn::link('status.name', 'Статус'),
                AdminColumn::custom('status')->setLabel('Статус')->setCallback(function($val){
                    return '<small class="'.$this->status_class[$val->status_id].'">'.$val->status->name.'</small>';
                }),
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $model_id = $this->model->find($id);

        $this->status = $model_id->status_id; // old status

        $tabs = AdminDisplay::tabbed();

        $formPrimary = AdminForm::form()->addElement(
         new FormElements([
                AdminFormElement::text('user.name', 'ник заказчика'),
                AdminFormElement::text('type_order.name', 'тип заказа'),
                AdminFormElement::text('type_client.name', 'тип клиента'),
                AdminFormElement::text('client_name', 'ФИО заказчика/Название компании'),
                AdminFormElement::text('phone', 'телефон'),
                AdminFormElement::text('address', 'адрес доставки'),
                AdminFormElement::textarea('comment', 'коментарий')->setReadOnly(true),
                AdminFormElement::select('status_id', trans('Статус'))->setModelForOptions(new \App\Status())->setDisplay('name')
            ])
        );
        $tabs->appendTab($formPrimary, 'Параметры заказа','style:red');

        $formCompany = AdminForm::form()->addElement(
        new FormElements([

                AdminFormElement::select('type_payment_id', trans('тип расчета'))->setModelForOptions(new TypePayment())->setDisplay('name'),
                AdminFormElement::text('company_full', 'Полное наименование компании'),
                AdminFormElement::text('edrpou', 'код ЕДРПОУ'),
                AdminFormElement::text('inn', 'код ИНН'),


               // AdminFormElement::columns()
                   // ->addColumn([
                AdminFormElement::text('code_index', 'почтовый индекс'),
                AdminFormElement::text('region', 'область'),
                AdminFormElement::text('area', 'район'),
                AdminFormElement::text('city', 'город'),
                  //  ], 3)
                   // ->addColumn([
                AdminFormElement::text('street', 'улица'),
                AdminFormElement::text('house', 'дом'),
                AdminFormElement::text('house_block', 'корпус'),
                AdminFormElement::text('office', 'номер офиса, квартиры')
                    //],3)
                    //],3)
            ])
        );
        $tabs->appendTab($formCompany, 'Параметры Компании');

        if($model_id->type_order_id == 2) {

            $formRepair = AdminForm::form()->addElement(
           new FormElements([
                    AdminFormElement::text('act_repair.device', 'ремонтируемое устройство'),
                    AdminFormElement::text('act_repair.set_device', 'комплектация'),
                    AdminFormElement::textarea('act_repair.text_defect', 'описание дефекта'),
                    AdminFormElement::text('act_repair.diagnostic', 'диагностика'),
                    AdminFormElement::text('act_repair.cost', 'стоимость'),
                    AdminFormElement::textarea('act_repair.comment', 'коментарий'),
                    AdminFormElement::select('act_repair.user_consent_id', trans('ответ заказчика'))->setModelForOptions(new UserConsent())->setDisplay('name')->setReadOnly(true),
                    AdminFormElement::select('act_repair.status_repair_id', trans('статус ремонта'))->setModelForOptions(new StatusRepair())->setDisplay('name')
                ])
            );
            $tabs->appendTab($formRepair, 'Параметры ремонта');

        }

        return $tabs;

    }

    /**
     * @return FormInterface
     */
   // public function onCreate()
   // {
  //      return $this->onEdit(null);
    //}

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
