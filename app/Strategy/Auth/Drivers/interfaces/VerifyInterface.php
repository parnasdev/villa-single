<?php


namespace App\Strategy\Auth\Drivers\interfaces;


interface VerifyInterface
{
    public function sendCode($request);

    public function verifyCode($request);
}
