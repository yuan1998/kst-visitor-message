<?php

namespace App\Http\Controllers\Api;

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
        $data = json_decode($request->get('data', null), true);

        if (!$data) {
            return $this->response->errorBadRequest();
        }
        $data = $this->safeDataFilter($data);

        if (in_array(array_get($data, 'dialogType', null), ['dt_v_ov', 'dt_v_nm'])) {
            return $this->response->array("ok")->setStatusCode(200);
        }

        $visitorId = $data['visitorId'];
        $recId = $data['recId'];

        if (!$visitorId) {
            return $this->response->errorBadRequest();
        }

        if (isset($data['dialogs'])) {
            $data['clue'] = $this->hasPhone($data['dialogs']);
        }

        $message = Message::where('visitorId', $visitorId)->where('recId' , $recId)->first();

        if (!$message) {
            $message = new Message();
            !empty($type) && $data['data_type'] = $type;
        }

        $message->fill($data);
        $message->save();

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
            $result = implode('|', $arr);
        }

        return $result ? DB::connection()->getPdo()->quote(utf8_encode($result)) : '';
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
