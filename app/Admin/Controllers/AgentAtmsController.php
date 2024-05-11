<?php

namespace App\Admin\Controllers;

use App\Models\AtmAgent;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AgentAtmsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Agentes ATM';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AtmAgent());
        $grid->column('id', __('ID')); // Adicione o campo 'id'
        $grid->column('atm_id', __('ATM ID'));
        $grid->column('user.name', __('Nome Do Agente'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(AtmAgent::findOrFail($id));

        $show->field('id', __('ID')); // Adicione o campo 'id'
        $show->field('atm_id', __('ATM ID'));
        $show->field('user.name', __('Agente Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new AtmAgent());

        $user = \App\Models\User::where('tipo_usuario', 'agente')->pluck('name', 'id');
        $atm = \App\Models\Atm::pluck('id', 'id');

        $form->select('atm_id', __('ATM'))->options($atm);
        $form->select('user_id', __('Agente'))->options($user);

        $form->display('id', __('ID')); // Adicione o campo 'id' como somente leitura
        $form->text('created_at', __('Created at'));
        $form->text('updated_at', __('Updated at'));

        // Adicione um campo oculto para o ID (caso você precise usá-lo no futuro)
        $form->hidden('id');

        // Adding a saving callback to the form
        $form->saving(function (Form $form) {
            $atmId = $form->atm_id;
            $selectedAgentId = $form->user_id;

            // Update the ATM status to 1
            \App\Models\Atm::where('id', $atmId)->update(['status' => 1]);
        });

        return $form;
    }
}
