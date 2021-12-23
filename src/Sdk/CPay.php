<?php

namespace CC\Sdk;

use CC\Sdk\Config\Credentials;
use JetBrains\PhpStorm\Pure;

class CPay
{
    public static function initWithCredentials(Credentials $credentials): Transaction
    {
        return new Transaction($credentials);
    }
}