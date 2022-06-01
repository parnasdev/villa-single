<?php


namespace App\PrsAuth\Contracts;


interface PrsAuthenticate
{
    public function getArray(array $data);

    public function authenticate();

    public function toggleTwoFactor();

    public function sendCodeTwoFactor();

    public function verifyTwoFactorCode();

    public function sendTempPassword();

    public function verifyTempPassword();

    public function logout();

    public function registration();

    public function sendVerifyCode();

    public function activeAccount();

    public function sendResetCode();

    public function verifyResetCode();
}
