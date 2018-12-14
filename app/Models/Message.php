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
        "dialogs",
        "data_type",
        "clue",
    ];

    protected $casts = [
        "curEnterTime"   => 'date:yyyy-mm-dd hh24:mi:ss',
        "diaStartTime"   => 'date:yyyy-mm-dd hh24:mi:ss',
        "diaEndTime"     => 'date:yyyy-mm-dd hh24:mi:ss',
        "firstVisitTime" => 'date:yyyy-mm-dd hh24:mi:ss',
        "preVisitTime"   => 'date:yyyy-mm-dd hh24:mi:ss',
        "dialogs"        => 'json'
    ];

    public static $requestTypeArray = [
        'rt_v'  => '访客请求',
        'rt_c'  => '客服请求',
        'rt_ct' => '本公司跨站点转接',
        'rt_ot' => '跨公司转接',
    ];

    public static $endTypeArray = [
        'et_v_e' => '访客主动结束',
        'et_c_e' => '客服主动结束',
        'et_c_r' => '客服拒绝对话',
        'et_t_s' => '跨站点转接转出',
        'et_t_c' => '跨公司转接转出',
        'et_c_o' => '客服网络断网',
        'et_c_q' => '客服退出系统',
        'et_d_t' => '对话状态超时',
    ];

    public static $dialogTypeArray = [
        'dt_v_ov' => '仅访问网站',
        'dt_v_nm' => '访客无消息',
        'dt_c_na' => '客服未接受',
        'dt_c_nm' => '客服无消息',
        'dt_d_o'  => '其他有效对话',
        'dt_d_n'  => '一般对话',
        'dt_d_g'  => '较好对话',
        'dt_d_b'  => '更好/极佳对话',
    ];

    public static $terminalTypeArray = [
        'tt_pc'  => '电脑',
        'tt_ppc' => '平板电脑',
        'tt_mb'  => '手机',
    ];

    public static  $dataTypeArray = [
        'zx' => '整形',
        'kq' => '口腔',
    ];

}
