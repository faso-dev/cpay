<?php

namespace CPay\Sdk;

use CPay\Sdk\Config\Credentials;

class Payment
{
    public static function initWithCredentials(Credentials $credentials): Transaction
    {
        return new Transaction($credentials);
    }
}