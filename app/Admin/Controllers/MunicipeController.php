<?php

namespace App\Admin\Controllers;

use App\Models\Municipe;
use App\Models\Province;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MunicipeController extends AdminController
{

    protected $title = 'Municípios';

    protected function grid()
    {
        $grid = new Grid(new Municipe());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Name'));
        $grid->column('province.name', __('Província'));
        // $grid->column('created_at', __('created_at'));
        // $grid->column('updated_at', __('updated_at'));

       // Botão de filtro
       $grid->filter(function ($filter) {
        // Filtro por nome
        $filter->like('name', __('Name'));
    });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Municipe::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Nome'));
        $show->field('province.name', __('Província'));
        // $show->field('created_at', __('created_at'));
        // $show->field('updated_at', __('updated_at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Municipe());

        $form->text('name', __('Name'));
        $provinces = Province::pluck('name', 'id');
        $form->select('id_province', __('Província'))->options($provinces);

        return $form;
    }
}
