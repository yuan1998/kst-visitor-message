<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CusTypeController extends Controller
{
    public function getKsCusTypeData($type , $call = false)
    {
        $client = new Client();
        $app    = array_get(Message::$app , $type , null);
        if (!$app) {
            if ($call) {
                return [];
            }
            else {
                return $this->response->errorBadRequest();
            }
        }

        $response = $client->request('GET', 'http://vipk16-hztk11.kuaishang.cn/bs/ksapi/getCusType.do', [
            'query' => getKsSign($app)
        ]);

        $content = json_decode($response->getBody()->getContents(), true);
        if($call) {
            return array_get($content, $content['result'], []);
        }

        return $this->response->array($content);
    }
}
