<?php


namespace App\Strategy\Auth\Drivers\interfaces;


interface RegisterInterface
{

    public function validateData($request);

    public function register($request);
}
