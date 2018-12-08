<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function store(Request $request) {
        logger("Card Request Data ========>");
        logger($request->all());
        logger("<======== Card Request Data");

        return $this->response->array("ok")->setStatusCode(200);
    }

    public function storeMessage(Request $request) {
        logger("Message Request Data ========>");
        logger($request->all());
        logger("<======== Message Request Data");

        return $this->response->array("ok")->setStatusCode(200);
    }
}
