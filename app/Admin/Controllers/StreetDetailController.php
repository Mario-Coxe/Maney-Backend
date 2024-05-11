<?php

namespace App\Admin\Controllers;

use App\Models\Street;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StreetDetailController extends AdminController
{
     /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Streets'; // Altere o título para "Streets"

     /**
     * Make a grid builder.
     *
     * @return Grid
     */

    protected function grid()
    {
        $grid = new Grid(new Street());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Name')); // Assuming 'name' is the field for street name
        $grid->column('municipe.name', __('Municipe'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->actions(function ($actions) {
            //$actions->enableView(); // Disable the edit button in the grid
            //$actions->disableView(); // Disable the view button in the grid
        });

        $grid->filter(function ($filter) {
          $filter->like('name', __('Name'));
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Street::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Name')); // Assuming 'name' is the field for street name
        $show->field('id_municipe', __('Municipe ID'));
        $show->column('created_at', __('Created at'));
        $show->column('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Street());

        $form->text('name', __('Name')); // Assuming 'name' is the field for street name
        $municipes = \App\Models\Municipe::pluck('name', 'id'); // Obtém os nomes dos municípios da tabela "municipes"
        $form->select('id_municipe', __('Municipio'))->options($municipes);

        $form->text('created_at', __('Created at'));
        $form->text('updated_at', __('Updated at'));

        return $form;
    }
}
