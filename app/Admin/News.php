<?php

namespace App\Admin;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class News
 *
 * @property \App\News $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class News extends Section implements Initializable
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
    protected $title = 'Новости';

    /**
     * @var string
     */
    protected $alias;


    public function initialize() {
        $this->addToNavigation()
            ->setIcon('fa fa-newspaper-o')
            ->setPriority(400)
            ->addBadge(function() {
                return \App\News::count();
            }, ['class' => 'label-info', 'title'=>'Всего новостей']);
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return  AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setOrder([[2, 'desc']]) // сортировка по номеру столбца отображаемого в админке
            ->setColumns(
                AdminColumn::link('id', 'id')->setWidth('50px'),
                AdminColumn::link('title', 'Название'),
                AdminColumn::datetime("published_at", "Дата<br>публикации")->setFormat('d.m.Y'),
                AdminColumnEditable::checkbox('published')->setLabel('Статус'),
                AdminColumn::custom('published')->setLabel('published')->setCallback(function($val){
                    return $val->published ? '<i class="fa fa-check-square-o" aria-hidden="true"></i>' : '<i class="fa fa-square-o" aria-hidden="true"></i>';
                })
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
                AdminFormElement::hidden('url')->setDefaultValue('news'),
                AdminFormElement::text('title', 'Title')->required()->unique(),
                AdminFormElement::wysiwyg('content', 'текс статьи')->required(),
                AdminFormElement::select('published', 'published',['0'=>'off', '1'=>'on'])->required(),
                // AdminFormElement::select('userInfo.marital_id', trans('labels.user.info.marital'))->setModelForOptions(new RefMarital)->setDisplay('name'),
                //AdminFormElement::radio('userInfo.gender', trans('labels.user.info.gender'))->setOptions(array('0' => trans('labels.user.info.gender_woman'), '1' => trans('labels.user.info.gender_man'))),
                AdminFormElement::date('published_at', 'published_at')
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
