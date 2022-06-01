<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserEdit extends Component
{

    public User $user;

    public function rules()
    {
        return [
            'user.name' => ['nullable'],
            'user.family' => ['nullable'],
            'user.role_id' => ['required'],
            'user.phone' => [Rule::when($this->user['username'] == '' && $this->user['email'] == '' , 'required' , 'nullable') , Rule::unique('users' , 'phone')->ignore($this->user->id)],
            'user.username' => [Rule::when($this->user['phone'] == '' && $this->user['email'] == '' ,'required' , 'nullable'), Rule::unique('users' , 'username')->ignore($this->user->id)],
            'user.email' => [Rule::when($this->user['username'] == '' && $this->user['phone'] == '' ,'required' , 'nullable') , Rule::unique('users' , 'email')->ignore($this->user->id)],
        ];
    }

    public function render()
    {
        $roles = Role::query()->get();
        return view('livewire.admin.users.user-edit' , compact('roles'));
    }

    public function submit()
    {
        $this->validate();

        $this->user->save();

        session()->flash('message' , ['title' =>  'کاربر شما با موفقیت ثبت شد.' , 'icon' => 'success']);

        return redirect(route('admin.users.index'));
    }
}
