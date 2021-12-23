<?php

namespace CC\Sdk;

class TransactionResponse implements TransactionResponseInterface
{
    private function __construct(protected int $status, protected string $message, protected ?string $transactionId = null)
    {
    }

    public static function fromXMLResponse(mixed $xmlResponse): self
    {
        return new self((int)$xmlResponse->status, (string)$xmlResponse->message, (string)$xmlResponse->transID);
    }

    /**
     * @inheritdoc
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @inheritdoc
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }


    /**
     * @inheritdoc
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}