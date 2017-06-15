<?php

namespace App\Admin;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\ActRepair;
use App\History;
use App\Http\Controllers\OrderController;
use App\Notifications\StatusOrder;
use App\Status;
use App\StatusRepairs;
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

    protected $id_order;
    protected $status; // status order
    protected $status_repair;
    protected $comment_repair;

    protected $status_class = ["1"=>"label label-danger", "2"=>"label label-warning", "3"=>"label label-success", "4"=>"label label-primary"];
    protected $status_repair_class = ["1"=>"badge label-danger", "2"=>"badge label-warning", "3"=>"badge label-success", "4"=>"badge label-primary",
        "5"=>"badge label-danger", "6"=>"badge label-warning", "7"=>"badge label-success", "8"=>"badge label-primary",
        "9"=>"badge label-danger", "10"=>"badge label-warning", "11"=>"badge label-success", "12"=>"badge label-primary",
        "13"=>"badge label-danger", "14"=>"badge label-warning"];


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
                $model->notify(new StatusOrder($status_name)); // Send email

                $history = new History();
                $history->order_id = $model->id;
                $history->status_info = 'Изменен статус заказа '.Status::find($this->status)->name.' -> '.Status::find($status)->name;
                $history->comment = Status::find($this->status)->name.' -> '.Status::find($status)->name;
                $history->save();
            }

            if($model->act_repair && $this->status_repair) {
                $status_repair = $model->act_repair->status_repair_id;
                if ($status_repair != $this->status_repair) {
                    $status_repair_name = StatusRepairs::find($status_repair)->name;
                    $model->notify(new StatusOrder($status_repair_name)); // Send email

                    $history = new History();
                    $history->order_id = $model->id;
                    $history->status_info = 'Изменен статус ремонта '.StatusRepairs::find($this->status_repair)->name . ' -> ' . StatusRepairs::find($status_repair)->name;
                    //$history->comment = StatusRepairs::find($this->status_repair)->name . ' -> ' . StatusRepairs::find($status_repair)->name;
                    $history->save();
                }

                $comment_repair = $model->act_repair->comment;
                if ($comment_repair != $this->comment_repair) {
                    $status_repair_name = StatusRepairs::find($status_repair)->name;
                    // $model->notify(new StatusOrder($status_repair_name));

                    $history = new History();
                    $history->order_id = $model->id;
                    $history->status_info = 'Комментарий Синт-Мастер';
                    $history->comment = $comment_repair;
                    $history->save();
                }
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
                AdminColumn::custom('status')->setLabel('Статус')->setCallback(function($val){
                    return '<small class="'.$this->status_class[$val->status_id].'">'.$val->status->name.'</small>';
                }),
                AdminColumn::custom()->setLabel('Статус ремонта')->setCallback(function($val){
                    $act_repair = ActRepair::where('order_id', $val->id)->first();
                        if($act_repair) {
                            return '<small class="' .$this->status_repair_class[$act_repair->status_repair_id].'">'.StatusRepairs::find($act_repair->status_repair_id)->name . '</small>';
                        }
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
        $model = $this->model->find($id);

        $this->id_order = $model->id;
        $this->status = $model->status_id; // old status

        if($model->act_repair) {
            $this->status_repair = $model->act_repair->status_repair_id; // old status_repair
            $this->comment_repair = $model->act_repair->comment;
        }

        $formPrimary = AdminForm::form()->addElement(
            new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::select('status_id', trans('Статус'))->setModelForOptions(new \App\Status())->setDisplay('name'),
                AdminFormElement::text('user.name', 'ник заказчика')->setReadOnly(true),
                AdminFormElement::text('type_order.name', 'тип заказа')->setReadOnly(true),
                AdminFormElement::text('type_client.name', 'тип клиента')->setReadOnly(true),
                AdminFormElement::text('client_name', 'ФИО заказчика/Название компании')->setReadOnly(true),
                AdminFormElement::text('phone', 'телефон')->setReadOnly(true),
                AdminFormElement::text('address', 'адрес доставки')->setReadOnly(true),
                AdminFormElement::textarea('comment', 'коментарий')->setReadOnly(true)
            ])
        );
        $formCompany = AdminForm::form()->addElement(
            new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::select('type_payment_id', trans('тип расчета'))->setModelForOptions(new TypePayment())->setDisplay('name')->setReadOnly(true),
                AdminFormElement::text('company_full', 'Полное наименование компании')->setReadOnly(true),
                AdminFormElement::text('edrpou', 'код ЕДРПОУ')->setReadOnly(true),
                AdminFormElement::text('inn', 'код ИНН')->setReadOnly(true),

                AdminFormElement::text('code_index', 'почтовый индекс')->setReadOnly(true),
                AdminFormElement::text('region', 'область')->setReadOnly(true),
                AdminFormElement::text('area', 'район')->setReadOnly(true),
                AdminFormElement::text('city', 'город')->setReadOnly(true),

                AdminFormElement::text('street', 'улица'),
                AdminFormElement::text('house', 'дом')->setReadOnly(true),
                AdminFormElement::text('house_block', 'корпус')->setReadOnly(true),
                AdminFormElement::text('office', 'номер офиса, квартиры')->setReadOnly(true)
            ])
        );

        $formRepair = AdminForm::form()->addElement(
            new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::select('act_repair.status_repair_id', trans('статус ремонта'))->setModelForOptions(new StatusRepairs())->setDisplay('name')->required(),
                AdminFormElement::text('act_repair.device', 'ремонтируемое устройство')->required(),
                AdminFormElement::text('act_repair.set_device', 'комплектация'),
                AdminFormElement::textarea('act_repair.text_defect', 'описание дефекта')->required(),
                AdminFormElement::text('act_repair.diagnostic', 'диагностика'),
                AdminFormElement::text('act_repair.cost', 'стоимость'),
                AdminFormElement::textarea('act_repair.comment', 'коментарий'),
                AdminFormElement::select('act_repair.user_consent_id', trans('ответ заказчика'))->setModelForOptions(new UserConsent())->setDisplay('name')->setReadOnly(true)
            ])
        );

        $formHistory = AdminFormElement::view('admin.history', ['id' => $this->id_order]);

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($formPrimary, 'Основное');
        $tabs->appendTab($formCompany, 'Параметры Компании');
        if($model->type_order_id == 2){
            $tabs->appendTab($formRepair, 'Параметры ремонта');
            $tabs->appendTab($formHistory, 'История');
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
