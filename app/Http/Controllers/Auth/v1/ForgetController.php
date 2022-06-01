<?php

namespace App\Http\Controllers\Auth\v1;

use App\Http\Controllers\Controller;
use App\Strategy\Auth\Drivers\interfaces\ForgetPasswordInterface;
use App\Strategy\Auth\Drivers\interfaces\RegisterInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ForgetController extends Controller
{
    public $forget;

    /**
     * Create a new controller instance.
     * @param ForgetPasswordInterface $forget
     */
    public function __construct(ForgetPasswordInterface $forget)
    {
        $this->forget = $forget;
    }

    public function changePassword(Request $request)
    {
        $res = $this->forget->changePassword($request);

        if (!$res['isDone']) {
            return result(false , null , null, $res['message'], 400);
        }

        return result(true , $res['data']);
    }
}
