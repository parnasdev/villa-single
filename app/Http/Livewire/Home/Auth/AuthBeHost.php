<?php

namespace App\Http\Livewire\Home\Auth;

use App\Models\User;
use App\PrsAuth\PrsAuth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AuthBeHost extends Component
{
    public string $step = 'validation';

    protected $queryString = ['step' => ['except' => 'validation'], 'is_temp' => ['as' => 'pass']];

    public array $user = ['username' => '','role' => 2]; //

    public bool $is_temp = false;

    public function mount()
    {
        $this->stepCheck();
    }

    public function render()
    {

        return view('livewire.home.auth.authBeHost');
    }

    public function submit()
    {
        match ($this->step) {
            'validation' => $this->validateData(),
            'login' => $this->login(),
            'register' => $this->activation()
        };
    }

    public function validateData()
    {
        $this->validate([
            'user.username' => 'required'
        ]);

        if (filter_var($this->user['username'], FILTER_VALIDATE_EMAIL)) {
            $column = 'email';
        } else {
            $column = 'phone';
        }

        $user = User::query()->where($column, $this->user['username'])->first();

        if (!empty($user)) {
            $this->step = 'login';
            if (is_null($user->password)) {
                $this->is_temp = true;
                $result = PrsAuth::getArray($this->user)->sendTempPassword();
                $this->dispatchBrowserEvent('message', ['message' => $result->getError(), 'btnCText' => 'باشه', 'btnCAText' => 'بستن']);
            }
            $this->stepCheck();
            return true;
        }

        if (filter_var($this->user['username'], FILTER_VALIDATE_EMAIL)) {
            $this->validate([
                'user.username' => ['required', 'email', Rule::unique('users', 'email')],
            ]);
        } else {
            $this->validate([
                'user.username' => ['required', 'string', 'digits:11', Rule::unique('users', 'phone')],
            ]);
        }
        $result = PrsAuth::getArray($this->user)->sendVerifyCode();
        if ($result) {
            $this->step = 'register';
            $this->stepCheck();
        }

        return true;
    }

    public function login()
    {
        $this->validate([
            'user.username' => 'required',
            'user.password' => 'required'
        ]);
        if ($this->is_temp) {
            $result = PrsAuth::getArray($this->user)->verifyTempPassword();
            if ($result instanceof User) {
                auth()->login($result);
                return redirect('/');
            }
        } else {
            $result = PrsAuth::getArray($this->user)->authenticate();
            if ($result->isSuccess) {
                return redirect('/');
            }

        }
        $this->addError('username', $result->getError());
    }

    public function activation()
    {
        if (filter_var($this->user['username'], FILTER_VALIDATE_EMAIL)) {
            $this->validate([
                'user.username' => ['required', 'email', $this->step == 'register' ? Rule::unique('users', 'email') : null],
                'user.token' => 'required'
            ]);
        } else {
            $this->validate([
                'user.username' => ['required', 'string', 'digits:11', $this->step == 'register' ? Rule::unique('users', 'phone') : null],
                'user.token' => 'required'
            ]);
        }
        $result = PrsAuth::getArray($this->user)->activeAccount();
        if ($result instanceof User) {
            auth()->login($result);

            return redirect('/');
        }

        return false;
    }

    public function validationCondition()
    {
        return $this->user;
    }

    public function loginCondition()
    {
        return $this->user = ['username' => $this->user['username'], 'password' => ''];
    }

    public function registerCondition()
    {
        return $this->user = ['username' => $this->user['username'], 'token' => '','role' => 2];
    }

    public function stepCheck()
    {
        match ($this->step) {
            'validation' => $this->validationCondition(),
            'login' => $this->loginCondition(),
            'register' => $this->registerCondition()
        };
    }

    public function sendMessage()
    {
        if (filter_var($this->user['username'], FILTER_VALIDATE_EMAIL)) {
            $this->validate([
                'user.username' => ['required', 'email', $this->step == 'register' ? Rule::unique('users', 'email') : null],
            ]);
        } else {
            $this->validate([
                'user.username' => ['required', 'string', 'digits:11', $this->step == 'register' ? Rule::unique('users', 'phone') : null],
            ]);
        }
        return match ($this->step) {
            'login' => $this->sendTempPassword(),
            'register' => PrsAuth::getArray($this->user)->sendVerifyCode()
        };
    }

    public function sendTempPassword()
    {
        PrsAuth::getArray($this->user)->sendTempPassword();
        $this->is_temp = true;

        return true;
    }

    public function changeUserRole() {
        if (user()->role_id == 3){
            user()->role_id = 2;
            user()->save(); 
        }
        $this->dispatchBrowserEvent('message', ['message' => 'میزبانی شما تایید شد . ممنون که میزبان اقامت با ما شدید به پنل خوش اومدید', 'btnCText' => 'باشه',  'btnCAText' => 'بستن']);
        return redirect('admin/panel');
    }
}
