<?php


namespace App\Strategy\Auth\Drivers\interfaces;


interface LoginInterface
{
    public function authenticate($request);

    public function certification($request);
}
