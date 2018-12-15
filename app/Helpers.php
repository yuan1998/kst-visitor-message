<?php

function inArrayOrNull($val, $arr, $null = '-')
{
    return isset($arr[$val]) ? $arr[$val] : $null;
}

function keyValueReplace($arr)
{
    $newArr = [];
    foreach ($arr as $key => $value) {
        $newArr[] = [$value => $key];
    }
    return $newArr;
}

function timeToString($second)
{
    $result = '';

    if ($second % 60 !== 0) {
        $result = ($second % 60) . "秒";
    }

    if ($second / 60 >= 1) {
        $result = intval($second / 60) . '分' . $result;
    }

    return $result;
}

function valueOfDefault($arr, $default)
{
    foreach ($arr as $key => $value) {
        if (!$value) {
            $arr[$key] = $default;
        }
    }
    return $arr;
}

function getKsSign($arr, $pushUrl = null, $pushType = null)
{
    $time   = \Carbon\Carbon::now()->timestamp * 1000;
    $tmpArr = [
        $arr['appKey'],
        $arr['appSet'],
        $arr['appToken'],
        $time,
    ];
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode($tmpArr);
    $data   = [
        'ak'     => $arr['appKey'],
        'tt'     => $time,
        'kssign' => sha1($tmpStr),
    ];
    $pushUrl && $data['pu'] = $pushUrl;
    $pushType && $data['pt'] = $pushType;
    return $data;
}

function repushRequest ($app , $pushUrl , $pushType)
{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'http://vipk16-hztk11.kuaishang.cn/bs/ksapi/repush.do', [
        'query' => getKsSign($app , $pushUrl,$pushType)
    ]);
    return json_decode($response->getBody()->getContents(), true);
}
