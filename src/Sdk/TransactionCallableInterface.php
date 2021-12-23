<?php

namespace CC\Sdk;

interface TransactionCallableInterface
{
    /**
     * @param callable $success
     * @param callable $error
     * @return mixed
     */
    public function on(callable $success, callable $error): mixed;
}