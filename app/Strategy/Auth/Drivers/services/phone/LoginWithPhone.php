<?php


namespace App\Strategy\Auth\Drivers\services\phone;


use App\Models\User;
use App\Strategy\Auth\Drivers\interfaces\LoginInterface;
use App\Strategy\Auth\Drivers\services\DefaultService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginWithPhone extends DefaultService implements LoginInterface
{

    public function authenticate($request) : array
    {
        $this->validate($request , [
            'username' => ['required'],
            'password' => ['required']
        ]);

        $data = $this->certification($request);

        $user = User::query()->where($data)->first();
        if (!is_null($user) && Hash::check($request->input('password') , $user->password)) {
            $token = $user->createToken($request);
            return ['isDone' => true , 'data' => [$user , $token]];
        }

        return ['isDone' => false, 'data' => [null , null]];
    }

    public function certification($request): array
    {
        if (is_numeric($request->input('username'))) {
            return [config('prs-auth.username') => $request->input('username')];
        } else {
            return ['username' => $request->input('username')];
        }
    }
}
