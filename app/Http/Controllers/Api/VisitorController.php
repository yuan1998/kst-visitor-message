<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Models\UserCard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public static $typeArray = [
        'zx' => 'http://message.xn--49sw11dtjh1kk.com/api/visitor',
        'kq' => 'http://message.xn--49sw11dtjh1kk.com/api/visitor/kq'
    ];

    public function store(Request $request, $type = null)
    {
        logger("<============ Visitor Store Start");
        $data = json_decode($request->get('data', null), true);

        if (!$data) {
            logger("Visitor Store Bad Request ============>");
            return $this->response->errorBadRequest();
        }
        $data = $this->safeDataFilter($data);

        $visitorId = $data['visitorId'];

        if (!$visitorId) {
            logger("Message Store Bad VisitorId ============>");
            return $this->response->errorBadRequest();
        }

        $card = UserCard::where('visitorId', $visitorId)->first();

        if (!$card) {
            logger("is New Visitor");
            $card = new UserCard();
            logger("type is $type");
            $type && $data['type'] = $type;
        }

        $card->fill($data);
        $card->save();

        logger("Message Store End . Save Success ============>");
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
