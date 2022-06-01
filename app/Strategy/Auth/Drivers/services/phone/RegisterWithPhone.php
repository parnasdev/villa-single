<?php


namespace App\Strategy\Auth\Drivers\services\phone;


use App\Models\User;
use App\Strategy\Auth\Drivers\interfaces\VerifyInterface;
use App\Strategy\Auth\Drivers\services\DefaultService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class RegisterWithPhone extends DefaultService implements \App\Strategy\Auth\Drivers\interfaces\RegisterInterface
{
    public $verify;

    public function __construct(VerifyInterface $verify)
    {
        $this->verify = $verify;
    }

    public function validateData($request)
    {
        $this->validate($request , [
            'username' => ['required']
        ]);

        return User::query()->where(config('prs-auth.username') , $request->input('username'))->firstOrFail();
    }

    public function register($request) : array
    {
        $res = $this->verify->verifyCode($request);

        if (!$res['isDone']) {
            return $res;
        }

        $user = User::query()->create([
            'phone' => $request->input('username'),
            'password'  => Hash::make($request->input('code'))
        ]);

        $token = $user->createToken($request);

        return ['isDone' => true , 'data' => ['user' => $user , 'token' => $token]];
    }
}
