<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class Controller extends \Illuminate\Routing\Controller
{
    /**
     * {@inheritdoc}
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return result(false, $errors , null, 'داده های ارسال شده نادرست می باشد.', 422);
    }
}
