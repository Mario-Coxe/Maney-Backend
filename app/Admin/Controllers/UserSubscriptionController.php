<?php

namespace App\Admin\Controllers;
use App\Models\UserSubscription;
use App\Models\User;
use App\Models\SubscriptionPlan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserSubscriptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Subscriçaõ do Úsuario';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserSubscription());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User'));
        $grid->column('subscriptionPlan.name', __('Subscription Plan'));
        $grid->column('start_date', __('Start date'));
        $grid->column('end_date', __('End date'));
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
        $show = new Show(UserSubscription::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User'));
        $show->field('subscriptionPlan.name', __('Subscription Plan'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
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
        $form = new Form(new UserSubscription());

        $form->select('user_id', __('User'))->options(User::pluck('name', 'id'));
        $form->select('subscription_plan_id', __('Subscription Plan'))->options(SubscriptionPlan::pluck('name', 'id'));
        $form->datetime('start_date', __('Start date'))->default(date('Y-m-d H:i:s'));
        $form->datetime('end_date', __('End date'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
