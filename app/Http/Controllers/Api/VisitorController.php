<?php

namespace App\Http\Controllers\Api;

use App\Models\UserCard;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request, $type=null)
    {
        $data = json_decode($request->get('data', null), true);

        if (!$data) {
            logger("<============ Visitor Store Bad Request ============>");
            return $this->response->errorBadRequest();
        }
        $data = $this->safeDataFilter($data);

        $visitorId = $data['visitorId'];
        if (!$visitorId) {
            logger("<============ Message Store Bad VisitorId ============>");
            return $this->response->errorBadRequest();
        }

        $card = UserCard::where('visitorId', $visitorId)->first();

        if (!$card) {
            $card = new UserCard();
            $type && $data['type'] = $type;
        }

        $card->fill($data);
        $card->save();

        return $this->response->array("ok")->setStatusCode(200);
    }
}
