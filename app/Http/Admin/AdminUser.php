<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Role;
use App\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class AdminUser
 *
 * @property \App\AdminUser $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class AdminUser extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'AdminUser';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->with('user', 'role')
            ->setHtmlAttribute('class', 'table-warning')
            ->setColumns([
                AdminColumn::link('user.name', 'Username'),
                AdminColumn::email('user.email', 'Email')->setWidth('150px'),
                AdminColumn::link('role.label', 'Roles')->setWidth('200px'),
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
            AdminFormElement::text('user.name', 'Username'),
            AdminFormElement::text('user.email', 'Username'),
            AdminFormElement::select('role_id', trans('Role'))->setModelForOptions(new Role())->setDisplay('name')
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
