<?php

namespace CC\Sdk\Config;

use CC\Utils\ReferenceGenerator;
use JetBrains\PhpStorm\Pure;

class TransactionData
{
    protected string $referenceNumber;


    private function __construct(protected string $clientNumber, protected string $amount, protected string $otp)
    {
    }

    #[Pure] public static function from(string $clientNumber, string $amount, string $otp): self
    {
        return new self($clientNumber, $amount, $otp);
    }

    /**
     * @return string
     */
    public function getClientNumber(): string
    {
        return $this->clientNumber;
    }

    /**
     * @param string $clientNumber
     * @return TransactionData
     */
    public function setClientNumber(string $clientNumber): self
    {
        $this->clientNumber = $clientNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     * @return TransactionData
     */
    public function setAmount(string $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getOtp(): string
    {
        return $this->otp;
    }

    /**
     * @param string $otp
     * @return TransactionData
     */
    public function setOtp(string $otp): self
    {
        $this->otp = $otp;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceNumber(): string
    {
        return $this->referenceNumber ?? ReferenceGenerator::token();
    }

    /**
     * @param string $referenceNumber
     * @return TransactionData
     */
    public function setReferenceNumber(string $referenceNumber): TransactionData
    {
        $this->referenceNumber = $referenceNumber;
        return $this;
    }

}