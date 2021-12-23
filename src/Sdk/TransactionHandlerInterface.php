<?php

namespace CC\Sdk;

interface TransactionHandlerInterface
{
    /**
     * @return TransactionResponseInterface
     */
    public function handleTransaction(): TransactionResponseInterface;
}