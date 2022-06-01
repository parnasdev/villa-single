<?php


namespace Packages\Villa\src\services;


use Illuminate\Support\Facades\Http;
use Packages\Villa\src\Models\Result;

class ApiService
{
    public function getCalender($request = [])
    {
        $response = new Result(Http::withoutVerifying()->post('http://calender-api.parnasweb.com' . '/v1/getCalender',$request)->body());
//dd(Http::withoutVerifying()->post('http://calender-api.parnasweb.com' . '/v1/getCalender',$request)->body());
        if ($response->isDone) {
            return $response->data;
        }

        return [];
    }


}
