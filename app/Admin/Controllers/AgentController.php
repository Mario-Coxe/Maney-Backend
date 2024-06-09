<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;


class AgentController extends AdminController
{
    protected $title = 'Agentes'; // Altere o título para "Agentes"

    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('ativo', __('Ativo'))->switch();
       // $grid->column('foto', __('Foto'));
        $grid->column('phone', __('Phone'));
        $grid->column('bank.name', __('Bank'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->model()->where('tipo_usuario', 'agente'); 
       


         // Botão de filtro
         $grid->filter(function ($filter) {
            // Filtro por nome
            $filter->like('name', __('Name'));
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('ativo', __('Ativo'))->switch();
       // $show->field('foto', __('Foto'));
        $show->field('phone', __('Phone'));
        $show->field('bank.name', __('Bank'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));


        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        return $show;
    }

    protected function form()
    {
        $form = new Form(new User());

        $bank = \App\Models\Banks::pluck('name', 'id');

        $form->text('name', __('Name'));
        $form->mobile('phone', __('Telefone para login'))->options(['mask' => '+(244) 999 999 999']);
        $form->text('tipo_usuario', __('Tipo usuario'))->default('agente')->readonly();
        $form->text('password', __('Password')); // Inclua o campo senha no formulário
        $form->switch('ativo', __('Ativo'));

        $form->select('bank_id', __('Bank'))->options($bank);

        //$form->image('agente.foto', __('Foto'))
           // ->move('public/images') // Diretório onde a imagem será armazenada
            //->uniqueName(); // Gera um nome único para cada imagem para evitar substituições

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
