<?php

namespace App\Admin\Controllers;

use App\ActRepair;
use App\History;
use App\Order;

use App\Status;
use App\StatusRepairs;
use App\TypeClient;
use App\TypeOrder;
use App\UserConsent;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;
use Request;

class OrderController extends Controller
{
    use ModelForm;

    protected $status ;
    protected $status_repair;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Заказы');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Заказы');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Заказы');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

    protected function grid()
    {
        return Admin::grid(Order::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');
            $grid->column('id', 'ID')->sortable();
            $grid->column('type_order.name', 'Тип услуги');
            $grid->column('type_client.name', 'Тип клиента');
            $grid->column('client_name', 'Клиент');
            $grid->column('status_id', 'Статус заказа')->display(function($id){
                $class = ["1"=>"label label-danger", "2"=>"label label-warning", "3"=>"label label-success", "4"=>"label label-primary"];
                return '<span class="'.$class[$id].'">'.Status::find($id)->name.'</span>';
            });

            //$grid->column('status_id')->editable(function ($id){
            //    $t = '<select>';
            //    foreach (Status::all() as $st){
             //       $t .= '<option>'.$st->name.'</option>';
           //     }
           //     $t .= '</select>';
             //   return $t;
          //  });

            //$grid->column('status_id', 'Статус')->select(Status::all()->pluck('name', 'id'));


            $grid->column('act_repair.status_repair_id', 'Статус ремонта')->display(function($id = 0){
                if($id != 0){
                    $class = ["1"=>"badge label-danger", "2"=>"badge label-warning", "3"=>"badge label-success", "4"=>"badge label-primary",
                        "5"=>"badge label-danger", "6"=>"badge label-warning", "7"=>"badge label-success", "8"=>"badge label-primary",
                        "9"=>"badge label-danger", "10"=>"badge label-warning", "11"=>"badge label-success", "12"=>"badge label-primary",
                        "13"=>"badge label-danger", "14"=>"badge label-warning"];
                    return '<span class="'.$class[$id].'">'.StatusRepairs::find($id)->name.'</span>';
                }
                return '';
            });

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('client_name', 'Клиент');
                $filter->is('type_order_id', 'Тип услуги')->select(TypeOrder::all()->pluck('name', 'id'));
                $filter->is('type_client_id', 'Тип клиента')->select(TypeClient::all()->pluck('name', 'id'));
                $filter->is('status_id', 'Статус заказа')->select(Status::all()->pluck('name', 'id'));
                $filter->is('act_repair.status_repair_id', 'Статус ремонта')->select(StatusRepairs::all()->pluck('name', 'id'));
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Order::class, function (Form $form) {


            $form->tab('Клиент/Компания', function(Form $form) {;

                $form->text('id', 'ID');
                $form->select('status_id', 'Статус заказа')->options(Status::all()->pluck('name', 'id'));
                $form->display('user.name', 'ник заказчика');
                $form->display('type_order.name', 'тип заказа');
                $form->display('type_client.name', 'тип клиента');
                $form->display('client_name', 'ФИО заказчика/Название компании');
                $form->display('phone', 'телефон');
                $form->display('address', 'адрес доставки');
                $form->display('comment', 'коментарий');

                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');

            })->tab('Реквизиты компании', function(Form $form){
                $form->display('type_payment.name', 'Тип расчета');
                $form->display('company_full', 'Полное наименование компании');
                $form->display('edrpou', 'код ЕДРПОУ');
                $form->display('inn', 'код ИНН');
                $form->display('code_index', 'почтовый индекс');
                $form->display('region', 'область');
                $form->display('area', 'район');
                $form->display('city', 'город');
                $form->display('street', 'улица');
                $form->display('house', 'дом');
                $form->display('house_block', 'корпус');
                $form->display('office', 'номер офиса, квартиры');
            })->tab('Параметры ремонта', function(Form $form){
                $form->select('act_repair.status_repair_id', 'Статус ремонта')->options(StatusRepairs::all()->pluck('name', 'id'));
                $form->text('act_repair.device', 'ремонтируемое устройство');
                $form->text('act_repair.set_device', 'комплектация');
                $form->textarea('act_repair.text_defect', 'описание дефекта');
                $form->textarea('act_repair.diagnostic', 'диагностика');
                $form->currency('act_repair.cost', 'стоимость')->symbol('грн.');
                $form->textarea('act_repair.comment', 'коментарий');
                $form->select('act_repair.user_consent_id', 'Ответ заказчика')->options(UserConsent::all()->pluck('name', 'id'));
            })->tab('История', function(Form $form){
                $form->html(function($form){
                    $histories = History::where('order_id', $form->model()->id)->get();
                    //var_dump($form);
                    return view('admin.history', ['histories' => $histories]);
                });

            });

            //$form->saving(function ($form){

            //    $this->status = Order::find($form->id)->status_id;
           //     $this->status_repair = ActRepair::where('order_id', $form->id)->first()->status_repair_id;
           // });

            //$form->saved(function($form){

             //   $status = $form->status_id;
             //   $status_repair = $form->act_repair['status_repair_id'];

               // $error = new MessageBag([
              //      'title'   => 'Order frm: '.$this->status.' to: '.$status,
               //     'message' => 'Repair frm: '.$this->status_repair.' to: '.$status_repair,
             //   ]);

           //     return back()->with(compact('error'));
//
            //});
        });
    }

    //public function release(Request $request)
    //{
        //foreach (Order::find($request->get('ids')) as $post) {
          //  $post->status = $request->get('action');
           // $post->save();
        //}
   // }
}
