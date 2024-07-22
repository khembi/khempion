<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ChatGPTInterface
{
    public function getResponse($input) : array;
}