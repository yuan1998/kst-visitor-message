<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getUrl(Request $request)
    {
        $url      = $request->get('url');
        $referrer = $request->get('referrer' , '');
        $client   = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url, [
            'Content-Type'   => "text/html;charset=UTF-8",
            'Accept'         => 'text/plain',
            'Accept-Charset' => 'iso-8859-5',
            'Referer' => $referrer,
            'request.options' => [
                'exceptions' => false,
            ]
        ]);

        $original_body = $response->getBody()->getContents();
        $utf8_body     = mb_convert_encoding((string)$original_body, 'ISO-8859-1', 'gbk');
        return $utf8_body;
        return $response->getBody()->getContents();
    }

    public function repushData(String $type) {
        $app     = array_get(Message::$app, $type, null);
        $visitorPushUrl = array_get(VisitorController::$typeArray, $type, null);
        $messagePushUrl = array_get(MessageController::$typeArray, $type, null);
        if (!$app) return $this->response->errorBadRequest();

        $result = [];
        if ($visitorPushUrl) $result['visitor_push_result'] = repushRequest($app, $visitorPushUrl, 'VISITORCARD');
        if ($messagePushUrl) $result['message_push_result'] = repushRequest($app, $messagePushUrl, 'HISTORYDATA');

        return $this->response->array($result);
    }
}
