<?php

namespace App\Http\Livewire\Home;

use App\Models\PostFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePage extends Component
{
    use WithFileUploads;

    public $user = [];

    public $file;

    public $newPassword = [
        'password' => '',
        'password_confirmation' => ''
    ];

    public $currentPassword = [
        'current_password' => '',
        'new_password' => ''
    ];

    public function mount()
    {
        $this->user = [
            'name' => user()->name,
            'family' => user()->family,
            'email' => user()->email,
            'phone' => user()->phone,
        ];
    }

    public function render()
    {
        return view('livewire.home.dashboard.profile-page');
    }

    public function editProfile()
    {
        $this->validate([
            'user.name' => ['required' , 'string' , 'max:50'],
            'user.family' => ['required' , 'string' , 'max:50'],
            'user.email' => ['nullable' , 'email' , 'string' , 'max:50'],
            'user.phone' => ['required' , 'string' , 'max:50'],
        ]);

        user()->update(
            $this->user
        );

        if ($this->file) {
            $url = $this->file->store('users' , 'public');

            PostFile::query()->create([
               'url' => Storage::url($url),
                'type' => 1,
                'private_path' => false,
                'post_fileable_id' => user()->id,
                'post_fileable_type' => get_class(user())
            ]);
        }

        $this->dispatchBrowserEvent('toastMessage' , ['message' => 'اطلاعات شما ثبت شد.'  , 'icon' => 'success']);

        $this->emit('updateUser');
    }

    public function changePassword() {
        $this->validate([
            'currentPassword.current_password' => ['required'],
            'currentPassword.new_password' => ['required' , 'string', 'min:8' , 'max:16'],
        ]);

        user()->update([
            'password' => Hash::make($this->currentPassword['new_password'])
        ]);

        $this->dispatchBrowserEvent('toastMessage' , ['message' => 'رمزعبور شما تغییر کرد.' , 'icon' => 'success']);
    }

    public function setPassword() {
        $this->validate([
            'newPassword.password' => ['required' , 'string', 'min:8' , 'max:16'],
            'newPassword.password_confirmation' => ['required'],
        ]);

        if ($this->newPassword['password'] !== $this->newPassword['password_confirmation']) {
            $this->addError('newPassword.password_confirmation' , trans('validation.confirmed' , 'رمزعبور تایید'));
            return false;
        }

        user()->update([
            'password' => Hash::make($this->newPassword['password'])
        ]);

        $this->dispatchBrowserEvent('toastMessage' , ['message' => 'رمزعبور ایجاد شد.' , 'icon' => 'success']);
    }
}