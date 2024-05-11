<?php


namespace App\Admin\Controllers;

use App\Models\Province;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProvinceDetailController extends AdminController
{
    protected $title = 'Provinces';

    protected function grid()
    {
        $grid = new Grid(new Province());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Name'));
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
        $show = new Show(Province::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Province());
        $form->text('name', __('Name'));
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
