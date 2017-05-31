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
 * Class Banner
 *
 * @property \App\Banner $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Banner extends Section
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
    protected $title = 'Баннеры';

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
            AdminColumn::link('title')->setLabel('title'),
                AdminColumn::link('active')->setLabel('статус')
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
            AdminFormElement::textarea('banner', 'banner'),
                AdminFormElement::select('active', 'active',['0'=>'off', '1'=>'on'])->required()
        );
    }

}
