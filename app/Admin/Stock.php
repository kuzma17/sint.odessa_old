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
 * Class Stock
 *
 * @property \App\Stock $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Stock extends Section
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
    protected $title = 'Акции';

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
                AdminColumn::link('title', 'title'),
                AdminColumn::image('banner', 'banner'),
                AdminColumn::datetime('from', 'from'),
                AdminColumn::datetime('to', 'to'),
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
                AdminFormElement::text('title', 'title'),
                AdminFormElement::image('banner', 'banner')->setUploadPath(function() {return 'images/banners';}),
                AdminFormElement::wysiwyg('content', 'content'),
                //AdminFormElement::custom()->setDisplay(view('admin/editor')),
                //AdminFormElement::custom()->setDisplay(function (\Illuminate\Database\Eloquent\Model $model){ return view('admin/editor',['text'=>$model]);}),
                AdminFormElement::date('from', 'from'),
                AdminFormElement::date('to', 'to'),
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
