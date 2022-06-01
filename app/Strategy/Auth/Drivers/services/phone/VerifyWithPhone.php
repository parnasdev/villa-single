<?php


namespace App\Strategy\Auth\Drivers\services\phone;


use App\Models\Code;
use App\Models\User;
use App\Strategy\Auth\Drivers\services\DefaultService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class VerifyWithPhone extends DefaultService implements \App\Strategy\Auth\Drivers\interfaces\VerifyInterface
{

    public function verifyCode($request)
    {
        $this->validate($request , [
            'username' => ['required' , Rule::when($request->input('type') == 'verify' , [Rule::unique('users' , config('prs-auth.username'))])],
            'code' => ['required'],
            'type' => ['required'],
            'password' => [Rule::requiredIf($request->input('type') == 'forget') , 'min:8']
        ]);

        if (!in_array($request->input('type') , ['forget' , 'verify'])) {
            return ['isDone' => false , 'message' => 'نوع ارسال پیام اشتباه میباشد.'];
        }
        $activeCode = Code::query()->where('code' , $request->input('code'))->first();

        if (is_null($activeCode)) {
            return ['isDone' => false , 'message' => 'کد تایید وجود ندارد'];
        }

        if ($activeCode->type != $request->input('type')) {
            return ['isDone' => false , 'message' => 'کد تایید وجود ندارد'];
        }

        if ($activeCode->code != $request->input('code')) {
            return ['isDone' => false , 'message' => 'کد تایید اشتباه میباشد.'];
        }

        if ($activeCode->expire < Carbon::now()) {
            return ['isDone' => false , 'message' => 'کد تایید منقضی شده است.'];
        }

        $activeCode->delete();

        return ['isDone' => true  , 'message' => null];
    }

    public function sendCode($request)
    {
        $this->validate($request , [
            'username' => ['required'],
            'type' => ['required'] // forget , verify
        ]);

        if (!in_array($request->input('type') , ['forget' , 'verify'])) {
            return ['isDone' => false , 'code' => null , 'message' => 'نوع ارسال پیام اشتباه میباشد.' , 'status' => 400];
        }

        if ($request->input('type') == 'forget') {
            $user = User::query()->where(config('prs-auth.username') , $request->input('username'))->get();

            if ($user->isEmpty()) {
                return ['isDone' => false , 'code' => null , 'message' => 'برای این کاربر امکان ارسال کد نمیباشد.' , 'status' => 400];
            }
        }

        $code = Code::createCode($request);

        return ['isDone' => true , 'code' => $code];
    }



}
