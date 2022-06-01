<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Component;

class RoleCreate extends Component
{
    public Role $role;

    public array $permissionIds = [];

    public function rules()
    {
        return [
            'role.name' => ['required' , 'string' , 'max:30'],
            'role.label' => ['required', 'string' , 'max:30'],
            'role.is_access_panel' => ['required'],
            'role.is_access_dashboard' => ['required'],
            'role.is_custom' => ['required'],
            'role.see_all_post' => ['required'],
            'role.custom_route_name_access' => [Rule::when($this->role->is_custom , 'required' , 'nullable')],
        ];
    }

    public function mount()
    {
        $this->role = new Role([
            'is_access_panel' => false,
            'is_access_dashboard' => false,
            'is_custom' => false,
            'see_all_post' => false,
            'is_default' => false,
        ]);
    }

    public function updated($name , $value)
    {
    }

    public function render()
    {
        $permissions = Permission::query()->get();
        return view('livewire.admin.roles.role-create' , compact('permissions'));
    }

    public function submit()
    {
        $this->validate();

        $this->role->save();

        session()->flash('message' , ['title' =>  'مقام شما با موفقیت ثبت شد.' , 'icon' => 'success']);

        return redirect(route('admin.roles.index'));
    }
}
