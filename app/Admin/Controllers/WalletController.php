<?php

namespace App\Admin\Controllers;
use App\Models\User;

use App\Models\Wallet;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WalletController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Carteira';

    protected function grid()
    {
        $grid = new Grid(new Wallet());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User')); // Assume que 'name' é o campo que você quer mostrar do usuário
        $grid->column('balance', __('Balance'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Wallet::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User')); // Assume que 'name' é o campo que você quer mostrar do usuário
        $show->field('balance', __('Balance'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Wallet());

        $form->select('user_id', __('User'))->options(User::all()->pluck('name', 'id')); // Assume que 'name' é o campo que você quer mostrar do usuário
        $form->decimal('balance', __('Balance'));

        return $form;
    }

}
