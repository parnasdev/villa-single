<?php


namespace App\PrsAuth\Services;


use App\Models\Code;
use App\Models\User;
use App\Notifications\SendEmailVerifyCode;
use App\Notifications\SendSMSVerifyCode;
use App\PrsAuth\errors\ErrorService;
use Illuminate\Support\Facades\Hash;

class PrsAuthenticateService extends \App\PrsAuth\Bases\PrsAuthenticateBase
{

    public function authenticate()
    {
        if (!auth()->attempt($this->credentialsData(), true)) {
            return new ErrorService(false, 1);
        }

        return new ErrorService(true, 0);
    }

    private function credentialsData()
    {
        if (filter_var($this->data['username'], FILTER_VALIDATE_EMAIL)) {
            return [
                'email' => $this->data['username'],
                'password' => $this->data['password']
            ];
        } else {
            return [
                'phone' => $this->data['username'],
                'password' => $this->data['password']
            ];
        }
    }

    public function toggleTwoFactor()
    {
        auth()->user()->update([
            'two_factor_auth' => $this->data['two_factor_status'],
            'two_factor_type' => $this->data['two_factor_type']
        ]);

        return $this;
    }

    public function sendCodeTwoFactor()
    {
        if (!auth()->user()->two_factor_auth) {
            return new ErrorService(false, 4);
        }

        if (auth()->user()->two_factor_type == 'email') {
            $result = $this->createCode(auth()->user()->email, 'email', 'twoFactor');
            if ($result instanceof Code) {
                $result->notify(new SendEmailVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
            return new ErrorService(true, 2);
        }

        if (auth()->user()->two_factor_type == 'phone') {
            $result = $this->createCode(auth()->user()->phone, 'phone', 'twoFactor');
            if ($result instanceof Code) {
                $result->notify(new SendSMSVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
            return new ErrorService(true, 2);
        }

        return new ErrorService(false, 3);
    }

    public function verifyTwoFactorCode()
    {
        $code = Code::query()->where('token', $this->data['token'])->firstOrFail();

        $result = $this->checkCode($code, 'twoFactor');

        if (!$result->isSuccess) {
            return $result;
        }

        $code->update([
            'used' => true
        ]);

        return $result;
    }

    public function sendTempPassword()
    {
        if (filter_var($this->data['username'], FILTER_VALIDATE_EMAIL)) {
            $result = $this->createCode($this->data['username'], 'email', 'temp');
            if ($result instanceof Code) {
                $result->notify(new SendEmailVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
            return new ErrorService(true, 2);
        } else {
            $result = $this->createCode($this->data['username'], 'phone', 'temp');
            if ($result instanceof Code) {
                $result->notify(new SendSMSVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
            return new ErrorService(true, 2);
        }
    }

    public function verifyTempPassword()
    {
        $code = Code::query()->where('token', $this->data['password'])->first();

        if (empty($code)) {
            return new ErrorService(false, 10);
        }

        $result = $this->checkCode($code, 'temp');

        if (!$result->isSuccess) {
            return $result;
        }

        $code->update([
            'used' => true
        ]);

        return User::query()->where($code->username_type, $code->username)->first();
    }

    public function logout()
    {
        auth()->logout();

        session()->regenerate();

        return new ErrorService(true, 0);
    }

    public function registration()
    {
        return $this;
    }

    public function sendVerifyCode()
    {
        if (filter_var($this->data['username'], FILTER_VALIDATE_EMAIL)) {
            $result = $this->createCode($this->data['username'], 'email', 'activation');
            if ($result instanceof Code) {
                $result->notify(new SendEmailVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
        } else {
            $result = $this->createCode($this->data['username'], 'phone', 'activation');
            if ($result instanceof Code) {
                $result->notify(new SendSMSVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
        }

        return new ErrorService(true, 2);
    }

    public function activeAccount()
    {
        $code = Code::query()->where('token', $this->data['token'])->first();

        if (empty($code)) {
            return new ErrorService(false, 10);
        }

        $result = $this->checkCode($code, 'activation');

        if (!$result->isSuccess) {
            return $result;
        }

        $code->update([
            'used' => true
        ]);

        return User::query()->create([
            $code->username_type => $code->username,
            $code->username_type . '_verified_at' => now(),
            'role_id' => $this->data['role'] ?? 3
        ]);
    }

    public function sendResetCode()
    {
        if (filter_var($this->data['username'], FILTER_VALIDATE_EMAIL)) {
            $result = $this->createCode($this->data['username'], 'email', 'reset');
            if ($result instanceof Code) {
                $result->notify(new SendEmailVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
            return new ErrorService(true, 2);
        } else {
            $result = $this->createCode($this->data['username'], 'phone', 'reset');
            if ($result instanceof Code) {
                $result->notify(new SendSMSVerifyCode());
            } else {
                return new ErrorService(false, 3);
            }
            return new ErrorService(true, 2);
        }
    }

    public function verifyResetCode()
    {
        $code = Code::query()->where('token', $this->data['token'])->first();

        if (empty($code)) {
            return new ErrorService(false, 10);
        }

        $result = $this->checkCode($code, 'reset');

        if (!$result->isSuccess) {
            return $result;
        }

        $code->update([
            'used' => true
        ]);

        $user = User::query()->where($code->username_type, $code->username)->first();

        $user->update([
            'password' => Hash::make($this->data['password'])
        ]);

        return $user;
    }

    private function checkCode($code, $type)
    {
        if ($code->token_type != $type) {
            return new ErrorService(false, 5);
        }

        if ($code->username != $this->data['username']) {
            return new ErrorService(false, 6);
        }

        if ($code->used) {
            return new ErrorService(false, 7);
        }

        if ($code->expire_at < now()) {
            return new ErrorService(false, 8);
        }

        return new ErrorService(true, 0);
    }

    public function createCode($username, $usernameType, $tokenType)
    {
        if ($tokenType != 'activation' && User::query()->where($usernameType, $username)->get()->isEmpty()) {
            return false;
        }

        $code = Code::query()->where('username', $username)->first();

        if (empty($code)) {
            return Code::query()->create([
                'username' => $username,
                'username_type' => $usernameType,
                'token' => $this->generateCode(),
                'token_type' => $tokenType,
                'expire_at' => now()->addMinutes(15),
            ]);
        }
        $code->update([
            'token' => $this->generateCode(),
            'token_type' => $tokenType,
            'used' => false,
            'expire_at' => now()->addMinutes(15),
        ]);
        return $code;
    }

    public function generateCode()
    {
        do {
            $code = rand(1000, 9999);
        } while (Code::query()->where('token', $code)->get()->isNotEmpty());

        return $code;
    }

}
