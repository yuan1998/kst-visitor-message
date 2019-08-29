<?php

namespace App\Http\Controllers\Api;

use App\Models\Dialog;
use App\Models\Message;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public static $typeArray = [
        'zx' => 'http://message.xn--49sw11dtjh1kk.com/api/message/zx',
        'kq' => 'http://message.xn--49sw11dtjh1kk.com/api/message/kq'
    ];

    public function store(Request $request, $type = null)
    {

        $data = $request->get('data', null);
        if ( env('PUSH_TO_SHUNDING',false) && $type === 'zx') {
            $client   = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'http://bmstest.snnting.com:8802/KST/GetReocrd',[
                'form_params' => ['data' =>urlencode($data) ],
                'exceptions' => false
            ]);
        }

        $data = json_decode($data, true);


        if (!$data) {
            logger('Bad Request: data not exists.');
            return $this->response->errorBadRequest();
        }
        $data = $this->safeDataFilter($data);

        if (in_array(array_get($data, 'dialogType', null), ['dt_v_ov', 'dt_v_nm'])) {
            return $this->response->array("ok")->setStatusCode(200);
        }

        $visitorId = $data['visitorId'];
        $recId = $data['recId'];

        if (!$visitorId) {
            logger('Bad Request: visitorId not exists.');
            return $this->response->errorBadRequest();
        }

        if (isset($data['dialogs'])) {
            $data['clue'] = $this->hasPhone($data['dialogs']);
            Dialog::generateDialogs($data['dialogs']);
        }

        !empty($type) && $data['data_type'] = $type;
        Message::updateOrCreate(
            $data,
            [
                'visitorId'=> $visitorId,
                'recId' => $recId,
            ]
        );
        return $this->response->array("ok")->setStatusCode(200);
    }

    public function hasPhone($json)
    {
        $result = '';
        if ($json) {
            $arr = [];
            foreach ($json as $value) {
                if ($value['recType'] == 1) {
                    $str = preg_replace('/\\".*?\\"/m', '', $value['recContent']);
                    $str = preg_replace('/<[^>]+>/m', '', $str);
                    preg_match_all('/([0-9A-Za-z\_\-\ \ ]{6,20})/m', $str, $matches);
                    isset($matches[0]) && ($arr = array_merge($arr, $matches[0]));
                }
            }
            $result = implode(',', $arr);
        }

        return $result;
    }

    public function repush($type)
    {
        $app     = array_get(Message::$app, $type, null);
        $pushUrl = array_get(self::$typeArray, $type, null);

        if (!$app || !$pushUrl) {
            return $this->response->errorBadRequest();
        }

        $content = repushRequest($app, $pushUrl, 'HISTORYDATA');
        return $this->response->array($content);
    }

}
