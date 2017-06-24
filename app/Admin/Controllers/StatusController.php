<?php

namespace App\Admin\Controllers;

use App\Status;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class StatusController extends Controller
{
    use ModelForm;


    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Статусы');
            $content->description('заказов');

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

            $content->header('Статусы');
            $content->description('заказов');

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

            $content->header('Статусы');
            $content->description('заказов');

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
        return Admin::grid(Status::class, function (Grid $grid) {

            $grid->column('id', 'ID')->sortable();
            $grid->column('id_1c', 'ID_1C')->sortable();
            $grid->column('name', "status");
            $grid->column('name_1c', "status 1C");
            $grid->column('color', "color")->display(function($color){
                return '<span class="badge" style="background-color: '.$color.'">'.$color.'</span>';
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Status::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('id_1c', 'ID 1C')->rules('required');
            $form->text('name', 'status')->rules('required');
            $form->text('name_1c', 'status 1C')->rules('required');
            $form->color('color', 'color');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
