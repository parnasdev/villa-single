<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $password = '';
    public $remember = false;

    public function rules()
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
        ];
    }


    public function mount()
    {

    }


    public function render()
    {
        return view('livewire.auth.login');
    }

    public function submit()
    {
        $this->validate();

        if (!auth()->attempt(['username' => $this->username , 'password' => $this->password])) {
            $this->addError('username' , trans('auth.failed'));
            return false;
        }

        session()->regenerate();
        user()->update([
           'last_login_at' => now()
        ]);
        return redirect(route('admin.panel'));
    }
}
