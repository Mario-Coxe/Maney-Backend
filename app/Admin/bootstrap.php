<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);
use Encore\Admin\Admin;
use Encore\Admin\Widgets\Menu;

Admin::menu(function (Menu $menu) {
    // Adicione os itens do menu aqui
    $menu->add('Dashboard', '/admin');
    $menu->add('wallets', '/wallets');
$menu->add('subscription-plans', '/subscription-plans');
$menu->add('users', '/users');
$menu->add('atms', '/atms');

});
