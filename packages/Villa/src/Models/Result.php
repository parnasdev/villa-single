<?php

namespace Packages\Villa\src\Models;

class Result
{
    public bool $isDone;
    public $data;
    public string $message;

    public function __construct($response)
    {
        $response = json_decode($response);
//        dd($response);
        $this->isDone = $response->isDone;
        $this->data = $response->data;
        $this->message = $response->message;
    }
}
