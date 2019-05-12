<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getUrl(Request $request) {
        $url = $request->get('url');
        $client   = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);

        return $response->getBody()->getContents();
    }
}
