<?php


namespace App\PrsAuth;


use Illuminate\Support\Facades\Facade;

/**
 * Class PrsAuth
 * @package App\PrsAuth
 * @method static PrsAuth getArray(array $data)
 * @method static authenticate()
 * @method static toggleTwoFactor()
 * @method static sendCodeTwoFactor()
 * @method static verifyTwoFactorCode()
 * @method static sendTempPassword()
 * @method static verifyTempPassword()
 * @method static logout()
 * @method static PrsAuth registration()
 * @method static sendVerifyCode()
 * @method static activeAccount()
 * @method static sendResetCode()
 * @method static verifyResetCode()
 */
class PrsAuth extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'prsauth';
    }
}
