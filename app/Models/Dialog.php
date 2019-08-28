<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $fillable = [
        'id',
        'recId',
        'recType',
        'sender',
        'dialogId',
        'addTime',
        'recContent',
    ];

    public function message() {
        return $this->belongsTo(Message::class , 'recId' , 'recId');
    }

    static public function generateDialogs($data) {
        collect($data)->each(function ($item) {
            Dialog::updateOrCreate($item , [
                'id' => $item['id']
            ]);
        });
    }
}
