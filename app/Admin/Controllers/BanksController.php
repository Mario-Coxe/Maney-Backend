<?php

namespace App\Admin\Controllers;

use App\Models\Banks;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BanksController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    protected $title = 'Banks';

    protected function grid()
    {
        $grid = new Grid(new Banks());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->actions(function ($actions) {
            // Add custom actions if needed
        });

        $grid->filter(function ($filter) {
            // Add filters if needed
        });

        return $grid;
    }


    protected function detail($id)
    {
        $show = new Show(Banks::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->column('slug', __('Slug'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Banks());
        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->text('created_at', __('Created at'));
        $form->text('updated_at', __('Updated at'));


        return $form;
    }

    public function getProvince()
    {
        return $this->grid()->render();
    }

    public function getProvinceById($id)
    {
        return $this->detail($id)->render();
    }
}
