<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionForm extends Model
{
    protected $table = 'question_form';

    protected $fillable = [
        'name',
        'phone',
        'gender',
        'od_fraction',
        'sr_fraction',
        'pn_fraction',
        'wt_fraction',
        'questions',
    ];

    protected $casts = [
        'questions' => 'json'
    ];
}
