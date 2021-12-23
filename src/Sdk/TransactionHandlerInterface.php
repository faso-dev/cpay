<?php

namespace CPay\Sdk;

interface TransactionHandlerInterface
{
    /**
     * @return TransactionResponseInterface
     */
    public function handleTransaction(): TransactionResponseInterface;
}