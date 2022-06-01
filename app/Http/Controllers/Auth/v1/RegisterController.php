<?php

namespace App\Http\Controllers\Auth\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Strategy\Auth\Drivers\interfaces\RegisterInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public $register;

    /**
     * Create a new controller instance.
     * @param RegisterInterface $register
     */
    public function __construct(RegisterInterface $register)
    {
        $this->register = $register;
    }

    public function validateData(Request $request)
    {
        try {
            $this->register->validateData($request);
            return result(true , [
                'authMode' => 1,
                'username' => $request->input('username')
            ]);
        } catch (\Exception | ValidationException $exception) {
            if ($exception instanceof ValidationException) {
                return result(false , $exception->errors() , null, 'داده های ارسال شده نادرست می باشد.', 422);
            }
            return result(true , [
                'authMode' => 2,
                'username' => $request->input('username')
            ]);
        }
    }

    public function register(Request $request)
    {
        $res = $this->register->register($request);

        if (!$res['isDone']) {
            return result(false , null , null, $res['message'], 400);
        }

        list($user , $token) = $res['data'];
        return result(true , ['user' => new UserResource($user) , 'token' => $token]);
    }
}
