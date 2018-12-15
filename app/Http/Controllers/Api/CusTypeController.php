<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CusTypeController extends Controller
{
    public static $data = null;

    public function getKsCusTypeData($type)
    {
        $content = cusTypeRequest($type);
        return $this->response->array($content);
    }

    public static function cusTypeData($type ,$key = null , $default = '-无-')
    {
        if (self::$data === null) {
            self::$data = cusTypeToSelect($type);
        }

        if ($key) {
            return array_get(self::$data , $key , $default);
        }
        return self::$data;
    }
}
