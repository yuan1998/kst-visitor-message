<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function store(Request $request, $type = null)
    {

        $data = json_decode($request->get('data', null), true);

        if (!$data) {
            logger("<============ Message Store Bad Request ============>");
            return $this->response->errorBadRequest();
        }
        $data = $this->safeDataFilter($data);

        if (in_array($data['dialogType'], ['dt_v_ov', 'dt_v_nm'])) {
            return $this->response->array("ok")->setStatusCode(200);
        }

        $visitorId = $data['visitorId'];

        if (!$visitorId) {
            logger("<============ Message Store Bad VisitorId ============>");
            return $this->response->errorBadRequest();
        }

        if (isset($data['dialogs'])) {
            $data['clue'] = $this->hasPhone($data['dialogs']);
        }

        $message = Message::where('visitorId', $visitorId)->first();

        if (!$message) {
            $message = new Message();
            $type && $data['data_type'] = $type;
        }

        $message->fill($data);
        $message->save();

        return $this->response->array("ok")->setStatusCode(200);
    }

    public function hasPhone($json)
    {
        $data   = json_decode($json, true);
        $result = '';
        if ($data) {
            $arr = [];
            foreach ($data as $value) {
                if ($value['recType'] == 1) {
                    preg_match_all('/([0-9A-Za-z\_\-])+/m', $value['recContent'], $matches);
                    isset($matches[0]) && ($arr = array_merge($arr, $matches[0]));
                }
            }
            $result = implode('|', $arr);
        }

        return $result;
    }

}
