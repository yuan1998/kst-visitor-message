<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\WechatJsSdkRequest;
use EasyWeChat\Factory;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function jssdkConfigBuilder(WechatJsSdkRequest $request)
    {
        $officialAccount = \EasyWeChat::officialAccount();
        $config=  $officialAccount->jssdk->buildConfig($request->get('jsApiList') , $request->get('debug' , false));

        return $this->response->array($config);
    }
}
