<?php


namespace App\Strategy\Auth\Drivers\services;


use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class DefaultService
{
    use ProvidesConvenienceMethods;

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return result(false, $errors , null, 'داده های ارسال شده نادرست می باشد.', 422);
    }
}
