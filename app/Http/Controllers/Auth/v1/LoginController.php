<?php

namespace App\Http\Controllers\Auth\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Strategy\Auth\Drivers\interfaces\ForgetPasswordInterface;
use App\Strategy\Auth\Drivers\interfaces\LoginInterface;
use App\Strategy\Auth\Drivers\interfaces\RegisterInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public $login;

    /**
     * Create a new controller instance.
     * @param LoginInterface $login
     */
    public function __construct(LoginInterface $login)
    {
        $this->login = $login;
    }

    public function login(Request $request)
    {
        $res = $this->login->authenticate($request);

        if (!$res['isDone']) {
            return result(false , [
                'username' => [
                    trans('auth.failed')
                ]
            ] , null, 422);
        }
        list($user , $token) = $res['data'];
        return result(true , ['user' => new UserResource($user) , 'token' => $token]);
    }
}
