<?php

namespace App\Admin;

use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Settings
 *
 * @property \App\Settings $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Settings extends Section
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
    protected $title = 'Параметры';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $settings = $this->model->first();
        return  view('admin.settings', ['settings' => $settings]);
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
                AdminFormElement::text('title', 'название сайта'),
                AdminFormElement::text('description', 'краткое опмсание сайта'),
                AdminFormElement::text('keywords', 'ключевые слова'),
                AdminFormElement::text('count_news', 'количество новостей на странице'),
                AdminFormElement::select('exchange', 'обмен 1С', ['0'=>'отключен', '1'=>'включен'])
            );
    }

}
