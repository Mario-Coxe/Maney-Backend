<?php
use App\Admin\Controllers\AtmCategoryController;
use App\Admin\Controllers\AtmController;
use App\Admin\Controllers\SubscriptionPlanController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\UserSubscriptionController;
use App\Admin\Controllers\WalletController;
use App\Admin\Controllers\AgentController;
use App\Admin\Controllers\StreetDetailController;
use App\Admin\Controllers\ProvinceDetailController;
use App\Admin\Controllers\MunicipeController;
use App\Admin\Controllers\AgentAtmsController;
use App\Admin\Controllers\AdvertisingController;
use App\Admin\Controllers\ChartjsController;
use Illuminate\Routing\Router;


Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('dashboard', ChartjsController::class);
    $router->resource('users', UserController::class);
    $router->resource('atms', AtmController::class);
    $router->resource('atm-categories', AtmCategoryController::class);
    $router->resource('agents', AgentController::class);
    $router->resource('street', StreetDetailController::class);
    $router->resource('province', ProvinceDetailController::class);
    $router->resource('municipe', MunicipeController::class);
    $router->resource('atribuir-atm-agente', AgentAtmsController::class);
    $router->resource('advertisings', AdvertisingController::class);
});
