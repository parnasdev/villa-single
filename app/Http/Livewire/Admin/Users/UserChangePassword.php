<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserChangePassword extends Component
{

    protected $listeners = ['getData'];

    public $password = '';

    public User $user;

    public function rules() {
        return [
            'password' => ['required' , Password::min(8)]
        ];
    }

    public function render()
    {
        return view('livewire.admin.users.user-change-password');
    }

    public function getData(User $user)
    {
        $this->user = $user;
    }

    public function submit() {
        $this->validate();

        $this->user->update([
            'password' => Hash::make($this->password)
        ]);

        session()->flash('message' , ['title' =>  'رمزعبور کاربر با موفقیت انجام شد.' , 'icon' => 'success']);

        $this->dispatchBrowserEvent('close-modal');
    }
}
