<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    use Helpers;

    public function safeDataFilter ($data) {
        $newData = [];
        foreach ($data as $key => $value) {
            !empty($value) && ($newData[$key] = $value);
        }

        return $newData;
    }
}
