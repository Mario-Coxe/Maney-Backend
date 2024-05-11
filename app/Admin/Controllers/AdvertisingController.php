<?php

namespace App\Admin\Controllers;
use App\NovaFields\CustomImage;

use App\Models\Advertising;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdvertisingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Advertising';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Advertising());

        $grid->column('id', __('Id'));
        $grid->column('owner', __('Name'));
        $grid->column('address', __('Image'));
        $grid->column('status', __('Status'))->switch();
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
        $show = new Show(Advertising::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('owner', __('Name'));
        $show->field('address', __('Image'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Advertising());

        $form->text('owner', __('Name'));
        $form->image('address', __('Image'));
        $form->switch('status', __('Status'));

        return $form;
    }
}
