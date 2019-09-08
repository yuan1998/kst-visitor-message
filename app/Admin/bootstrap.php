<?php

use Encore\Admin\Grid\Column;
use Encore\Admin\Admin;
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


Column::extend('defaultNull', function ($value , $default = '-无-') {
    return $value ?: $default;
});
Column::extend('cardModal' , \App\Admin\Extensions\CardModal::class);
Column::extend('messageModal' , \App\Admin\Extensions\Modal::class);
Admin::css('/asset/custom.min.css');
