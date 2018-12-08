<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function store(Request $request)
    {
        $data = json_decode($request->get('data', null), true);

        if (!$data) {
            logger("<============ Message Store Bad Request ============>");
            return $this->response->errorBadRequest();
        }
        $data = $this->safeDataFilter($data);

        $visitorId = $data['visitorId'];

        if (!$visitorId) {
            logger("<============ Message Store Bad VisitorId ============>");
            return $this->response->errorBadRequest();
        }

        $message = Message::where('visitorId', $visitorId)->first();

        if (!$message) {
            $message = new Message();
        }

        $message->fill($data);
        $message->save();

        return $this->response->array("ok")->setStatusCode(200);
    }

}
