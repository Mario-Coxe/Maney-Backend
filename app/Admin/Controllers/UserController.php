<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Clientes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('phone', __('Phone'));
        $grid->column('tipo_usuario', __('Tipo usuario'));
        $grid->column('ativo', __('Ativo'));
        $grid->column('ultima_atividade', __('Ultima atividade'));
        $grid->column('foto', __('Foto'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->model()->where(function ($query) {
            $query->where('tipo_usuario', 'cliente')
                  ->orWhere('tipo_usuario', 'other');
        });

         // Botão de filtro
         $grid->filter(function ($filter) {
            // Filtro por nome
            $filter->like('name', __('Name'));
            $filter->like('phone', __('Phone'));
        });

        //NAO ESTOU USANDO, É DESNECESSARIO MOSTRAR
        // $grid->column('remember_token', __('Remember token'));
        // $grid->column('email', __('Email'));
        //$grid->column('password', __('Password'));
        // $grid->column('provider_name', __('Provider name'));
        // $grid->column('provider_id', __('Provider id'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('phone', __('Phone'));
        $show->field('tipo_usuario', __('Tipo usuario'));
        $show->field('ativo', __('Ativo'));
        $show->field('ultima_atividade', __('Ultima atividade'));
        $show->field('foto', __('Foto'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        //NAO ESTOU USANDO, É DESNECESSARIO MOSTRAR

        // $show->field('email', __('Email'));
        // $show->field('password', __('Password'));
        // $show->field('provider_name', __('Provider name'));
        // $show->field('provider_id', __('Provider id'));
        // $show->field('remember_token', __('Remember token'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());
        $form->text('name', __('Name'));
        $form->mobile('phone', __('Telefone para login'))->options(['mask' => '+(244) 999 999 999']);
        $form->text('tipo_usuario', __('Tipo usuario'))->default('cliente')->readonly();
        $form->text('password', __('Password')); // Inclua o campo senha no formulário
        $form->switch('ativo', __('Ativo'));


        $form->image('agente.foto', __('Foto'))
            ->move('public/images') // Diretório onde a imagem será armazenada
            ->uniqueName(); // Gera um nome único para cada imagem para evitar substituições

        // Outros campos para o motorista...
        $form->saving(function (Form $form) {
            // remove the mask from the phone number
            $form->phone = str_replace('+(244)', '', $form->phone);
            $form->phone = preg_replace('/\D/', '', $form->phone);

            // check for password field and update if present
            if (!empty($form->password)) {
                $form->password = Hash::make($form->password);
            } else {
                // get the original password and set it to the password field
                $form->password = $form->model()->password;
            }
        });

      
        return $form;
    }
}
