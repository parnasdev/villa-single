<?php


namespace App\PrsAuth\Bases;


abstract class PrsAuthenticateBase implements \App\PrsAuth\Contracts\PrsAuthenticate
{

    public ?array $data = null;

    public function getArray(array $data)
    {
        $this->data = $data;

        return $this;
    }

    abstract public function authenticate();

    abstract public function toggleTwoFactor();

    abstract public function sendCodeTwoFactor();

    abstract public function verifyTwoFactorCode();

    abstract public function sendTempPassword();

    abstract public function verifyTempPassword();

    abstract public function logout();

    abstract public function registration();

    abstract public function sendVerifyCode();

    abstract public function activeAccount();

    abstract public function sendResetCode();

    abstract public function verifyResetCode();
}
