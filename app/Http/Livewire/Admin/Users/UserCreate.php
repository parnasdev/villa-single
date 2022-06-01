<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserCreate extends Component
{
    public array $user = [
        'name' => '',
        'family' => '',
        'role_id' => '',
        'phone' => '',
        'username' => '',
        'email' => '',
        'password' => '',
    ];

    public function rules()
    {
        return [
            'user.name' => ['nullable'],
            'user.family' => ['nullable'],
            'user.role_id' => ['required'],
            'user.phone' => [Rule::when($this->user['username'] == '' && $this->user['email'] == '' , 'required' , 'nullable') , Rule::unique('users' , 'phone')],
            'user.username' => [Rule::when($this->user['phone'] == '' && $this->user['email'] == '' ,'required' , 'nullable'), Rule::unique('users' , 'username')],
            'user.email' => [Rule::when($this->user['username'] == '' && $this->user['phone'] == '' ,'required' , 'nullable') , Rule::unique('users' , 'email')],
            'user.password' => ['required' , Password::min(8)],
        ];
    }

    public function render()
    {
        $roles = Role::query()->get();
        return view('livewire.admin.users.user-create' , compact('roles'));
    }

    public function submit()
    {
        $this->validate();

        $user = new User(array_merge($this->user , ['password' => Hash::make($this->user['password'])]));

        $user->save();

        session()->flash('message' , ['title' =>  'کاربر شما با موفقیت ثبت شد.' , 'icon' => 'success']);

        return redirect(route('admin.users.index'));
    }
}
