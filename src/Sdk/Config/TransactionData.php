<?php

namespace CPay\Sdk\Config;

use CPay\Utils\ReferenceGenerator;

class TransactionData
{
    protected string $referenceNumber;

    protected string $clientNumber;

    protected string $paymentAmount;

    protected string $otp;


    private function __construct(string $clientNumber, string $paymentAmount, string $otp)
    {
        $this->otp = $otp;
        $this->paymentAmount = $paymentAmount;
        $this->clientNumber = $clientNumber;
    }

    public static function from(string $clientNumber, string $paymentAmount, string $otp): self
    {
        return new self($clientNumber, $paymentAmount, $otp);
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
    public function getPaymentAmount(): string
    {
        return $this->paymentAmount;
    }

    /**
     * @param string $paymentAmount
     * @return TransactionData
     */
    public function setAmount(string $paymentAmount): self
    {
        $this->paymentAmount = $paymentAmount;
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