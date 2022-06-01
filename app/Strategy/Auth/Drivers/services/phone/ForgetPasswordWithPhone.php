<?php


namespace App\Strategy\Auth\Drivers\services\phone;


use App\Models\User;
use App\Strategy\Auth\Drivers\interfaces\ForgetPasswordInterface;
use App\Strategy\Auth\Drivers\interfaces\VerifyInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ForgetPasswordWithPhone implements ForgetPasswordInterface
{
    public $verify;

    public function __construct(VerifyInterface $verify)
    {
        $this->verify = $verify;
    }

    public function changePassword($request)
    {
        $res = $this->verify->verifyCode($request);

        if (!$res['isDone']) {
            return $res;
        }

        $user = User::query()->where(config('prs-auth.username') , $request->input('username'))->first();

        $user->update([
            'password'  => Hash::make($request->input('password'))
        ]);

        $token = $user->createToken($request);
        return ['isDone' => true , 'data' => ['user' => $user , 'token' => $token]];
    }
}
