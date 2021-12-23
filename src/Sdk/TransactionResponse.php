<?php

namespace CC\Sdk;

class TransactionResponse
{
    private function __construct(protected int $status, protected string $message, protected ?string $transactionId = null)
    {
    }

    public static function fromXMLResponse(mixed $xmlResponse): self
    {
        return new self((int)$xmlResponse->status, (string)$xmlResponse->message, (string)$xmlResponse->transID);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }


    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}