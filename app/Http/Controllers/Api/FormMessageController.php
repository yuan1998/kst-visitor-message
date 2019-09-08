<?php

namespace App\Http\Controllers\Api;

use App\Models\FormMessage;
use Illuminate\Http\Request;

class FormMessageController extends Controller
{
    public function store(Request $request) {
        $data = $request->only(['name' , 'phone' ,'url' , 'description' , 'gender']);

        FormMessage::create($data);

        return $this->response->created();
    }
}
