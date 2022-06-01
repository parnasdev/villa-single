<?php

namespace App\Http\Controllers\Auth\v1;

use App\Http\Controllers\Controller;
use App\Strategy\Auth\Drivers\interfaces\ForgetPasswordInterface;
use App\Strategy\Auth\Drivers\interfaces\RegisterInterface;
use App\Strategy\Auth\Drivers\interfaces\VerifyInterface;
use Illuminate\Http\Request;

class SenderController extends Controller
{
    public $verify;
    /**
     * Create a new controller instance.
     *
     */
    public function __construct(VerifyInterface $verify)
    {
        $this->verify = $verify;
    }

    public function sendCode(Request $request)
    {

        $res = $this->verify->sendCode($request);

        if (!is_null($res) && !$res['isDone']) {
            return result(false , $res['code'] , null , $res['message'] , $res['status']);
        }

        // Todo: send Notification

        return result(true , $res['code'] , null , 'کد تایید | احراز برای شما ارسال شد.');
    }

}
