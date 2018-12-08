<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    public function store(Request $request) {
        logger("Request Data ========>");
        logger($request->all());
        logger("<======== Request Data");

        return $this->response->noContent()->setStatusCode(200);
    }
}
