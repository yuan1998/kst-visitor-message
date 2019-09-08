<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormMessage extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'gender',
        'description',
        'url',
    ];

    static public $genderList = [
        0 => '未知',
        1 => '男',
        2 => '女',
    ];

}
