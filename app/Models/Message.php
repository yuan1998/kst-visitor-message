<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "recId",
        "visitorId",
        "visitorName",
        "curEnterTime",
        "curStayTime",
        "sourceIp",
        "sourceProvince",
        "sourceIpInfo",
        "requestType",
        "endType",
        "diaStartTime",
        "diaEndTime",
        "terminalType",
        "visitorSendNum",
        "csSendNum",
        "sourceUrl",
        "sourceType",
        "searchEngine",
        "keyword",
        "firstCsId",
        "joinCsIds",
        "dialogType",
        "firstVisitTime",
        "preVisitTime",
        "totalVisitTime",
        "diaPage",
        "curFirstViewPage",
        "curVisitorPages",
        "preVisitPages",
        "operatingSystem",
        "browser",
        "info",
        "siteName",
        "siteId",
        'dialogs',
    ];

    protected $casts = [
        "curEnterTime"   => 'date:yyyy-mm-dd hh24:mi:ss',
        "diaStartTime"   => 'date:yyyy-mm-dd hh24:mi:ss',
        "diaEndTime"     => 'date:yyyy-mm-dd hh24:mi:ss',
        "firstVisitTime" => 'date:yyyy-mm-dd hh24:mi:ss',
        "preVisitTime"   => 'date:yyyy-mm-dd hh24:mi:ss',
        "dialogs"        => 'json'
    ];

}
