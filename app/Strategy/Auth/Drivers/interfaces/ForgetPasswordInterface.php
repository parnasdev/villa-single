<?php


namespace App\Strategy\Auth\Drivers\interfaces;



interface ForgetPasswordInterface
{
    public function changePassword($request);
}
