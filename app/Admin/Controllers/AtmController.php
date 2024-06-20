<?php

namespace App\Admin\Controllers;

use App\Models\Atm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AtmController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ATMs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Atm());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        //$grid->column('latitude', __('Latitude'));
        //$grid->column('longitude', __('Longitude'));
        //$grid->column('address', __('Address'));
        $grid->column('has_cash', __('Has cash'))->switch();
        $grid->column('has_paper', __('Has Papel'))->switch();
        $grid->column('how_many_cash', __('How many cash'));
        $grid->column('how_many_paper', __('How many paper'));
        $grid->column('status', __('Status'));
        $grid->column('street.name', __('Street'));
        //$grid->column('municipe.name', __('Municipe'));
        //$grid->column('bank.name', __('Bank'));
        //$grid->column('updated_at', __('Updated at'));

        // Botão de filtro
        $grid->filter(function ($filter) {
            // Filtro por nome
            $filter->like('name', __('Name'));

            // Filtro por endereço
            $filter->like('address', __('Address'));

            // Filtro por status
            $filter->equal('status', __('Status'))->select([
                '1' => __('Activo'),
                '0' => __('Inativo')
            ]);

            // Filtro por com dinheinho
            $filter->equal('has_cash', __('Dinheiro'))->select([
                '1' => __('Activo'),
                '0' => __('Inativo')
            ]);

            // Filtro por Papel
            $filter->equal('has_paper', __('Papel'))->select([
                '1' => __('Activo'),
                '0' => __('Inativo')
            ]);

            // Filtro por nome da rua
            $filter->where(function ($query) {
                $query->whereHas('street', function ($query) {
                    $query->where('name', 'like', "%{$this->input}%");
                });
            }, __('Street'));
        });

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
        $show = new Show(Atm::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
        $show->field('address', __('Address'));
        $show->field('has_cash', __('Has cash'))->switch();
        $show->field('has_paper', __('Has Papel'))->switch();
        $show->field('how_many_cash', __('How many cash'));
        $show->field('how_many_paper', __('How many paper'));
        $show->field('id_street', __('Id Street'));
        $show->field('municipe.name', __('Municipe'));
        $show->field('status', __('Status'));
        $show->field('bank.name', __('Bank'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Atm());

        $form->text('name', __('Name'));
        $form->decimal('latitude', __('Latitude'));
        $form->decimal('longitude', __('Longitude'));
        $form->text('address', __('Address'));
        $form->switch('has_cash', __('Has cash'));
        $form->switch('has_paper', __('Has Papel'));
        $form->number('how_many_cash', __('How many cash'));
        $form->number('how_many_paper', __('How many paper'));
        $form->switch('status', __('Status'));

        $streets = \App\Models\Street::pluck('name', 'id');
        $municipes = \App\Models\Municipe::pluck('name', 'id');
        $banks = \App\Models\Banks::pluck('name', 'id');

        $form->select('id_street', __('Street'))->options($streets);
        $form->select('id_municipe', __('Municipe'))->options($municipes);
        $form->select('bank_id', __('Bank'))->options($banks);


        return $form;
    }
}
