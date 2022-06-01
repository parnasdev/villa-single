<?php

namespace App\Http\Livewire\Home\sections;

use App\PrsAuth\PrsAuth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Headers extends Component
{
    public $route;

    public function mount()
    {
        $this->route = Route::currentRouteName();
    }

    public function render()
    {
        return view('livewire.home.sections.headers');
    }

    public function logout()
    {
        PrsAuth::getArray([])->logout();
        return redirect('/');
    }
}
