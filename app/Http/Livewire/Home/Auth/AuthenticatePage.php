<?php

namespace App\Http\Livewire\Home\Auth;

use App\Models\Code;
use App\Models\User;
use App\Notifications\SendEmailVerifyCode;
use App\Notifications\SendSMSVerifyCode;
use App\PrsAuth\errors\ErrorService;
use App\PrsAuth\PrsAuth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;

class AuthenticatePage extends Component
{
    public string $step = 'validation';

    public $referrer_url = '/';

    public $buttonSelected = true;

    protected $queryString = ['step' => ['except' => 'validation'], 'is_temp' => ['as' => 'pass'], 'referrer_url' => ['except' => '/','as' => 'referrer-url']];

    public array $user = ['username' => '']; // role => 2

    public bool $is_temp = false;

    public function mount()
    {
        $this->stepCheck();
    }

    public function render()
    {
        return view('livewire.home.auth.authenticate-page');
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
                $result = $this->sendMessage();
                $this->dispatchBrowserEvent('toastMessage', ['message' => $result->getError(), 'icon' => 'info']);
            }
            $this->stepCheck();
            $this->buttonSelected = false;
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
                return redirect($this->referrer_url);
            }
        } else {
            $result = PrsAuth::getArray($this->user)->authenticate();
            if ($result->isSuccess) {
                return redirect($this->referrer_url);
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

            return redirect($this->referrer_url);
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
        return $this->user = ['username' => $this->user['username'], 'token' => ''];
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
        $this->buttonSelected = true;
        return match ($this->step) {
            'login' => $this->sendTempPassword(),
            'register' => PrsAuth::getArray($this->user)->sendVerifyCode()
        };
    }

    public function sendTempPassword()
    {
        $result = PrsAuth::getArray($this->user)->sendTempPassword();
        $this->is_temp = true;

        return $result;
    }
}
