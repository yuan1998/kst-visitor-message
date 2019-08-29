<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Models\UserCard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public static $typeArray = [
        'zx' => 'http://message.xn--49sw11dtjh1kk.com/api/visitor/zx',
        'kq' => 'http://message.xn--49sw11dtjh1kk.com/api/visitor/kq'
    ];

    public function store(Request $request, $type = null)
    {
        $data = $request->get('data', null);
        if (env('PUSH_TO_SHUNDING',false) && $type === 'zx') {
            $client   = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'http://bmstest.snnting.com:8802/KST/GetCard',['form_params' => ['data' => urlencode($data) ]]);
        }

        $data = json_decode($data, true);

        if (!$data) {
            logger('Bad Request . data Not Exists.');
            return $this->response->errorBadRequest('Bad Request . Not Found Data Paramater.');
        }
        $data = $this->safeDataFilter($data);

        $visitorId = $data['visitorId'];

        if (!$visitorId) {
            logger('Bad Request . visitorId Not Exists.');
            return $this->response->errorBadRequest('Bad Request . Not Found Visitor Id.');
        }
        $type && ($data['type'] = $type);

        UserCard::updateOrCreate(
            $data,
            [
                'visitorId' => $visitorId
            ]
        );

        return $this->response->array("ok")->setStatusCode(200);
    }


    public function repush($type)
    {
        $app     = array_get(Message::$app, $type, null);
        $pushUrl = array_get(self::$typeArray, $type, null);

        if (!$app || !$pushUrl) {
            return $this->response->errorBadRequest();
        }

        $content = repushRequest($app, $pushUrl, 'VISITORCARD');
        return $this->response->array($content);
    }

}
