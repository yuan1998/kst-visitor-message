<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{

    protected $fillable = [
        'visitorId',
        'linkman',
        'cusType',
        'compName',
        'compId',
        'webUrl',
        'mobile',
        'phone',
        'qq',
        'msn',
        'email',
        'address',
        'birthday',
        'birthday',
        'col1',
        'col2',
        'col3',
        'col4',
        'col5',
        'col6',
        'col7',
        'col8',
        'col9',
        'remark',
        'loginName',
        'userName',
        'nickName',
        'addtime',
        'lastChangeTime',
    ];

    protected $table = 'user_cards';

    protected $casts = [
        'addtime'        => 'date:yyyy-mm-dd hh24:mi:ss',
        'lastChangeTime' => 'date:yyyy-mm-dd hh24:mi:ss',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class , 'visitorId' , 'visitorId');
    }

}
