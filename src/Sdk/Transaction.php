<?php

namespace CC\Sdk;


use CC\Http\RequestBody;
use CC\Http\XMLHttp;
use CC\Sdk\Config\Credentials;
use CC\Sdk\Config\TransactionData;

class Transaction implements PayementInterface
{
    private const DEV_API_URL = "https://testom.orange.bf:9008/payment";
    private const PROD_API_URL = "https://apiom.orange.bf:9007/payment";

    protected string $apiUrl;

    protected TransactionData $transactionData;

    protected bool $withSSLVerification = XMLHttp::WITH_SSL_ENABLED;

    public function __construct(protected Credentials $credentials)
    {
        $this->useDevApi();
    }

    public function submit(callable $onSuccess, callable $onError): mixed
    {
        [$errno, $error, $response] = $this->processRequest();
        if ($errno > 0) {
            return $onError($error, $errno);
        }
        if ((int)$response->status !== 200) {
            return $onError((string)$response->message, (int)$response->status);
        }

        return $onSuccess($response);
    }

    public function withoutSSLVerification(): self
    {
        $this->withSSLVerification = XMLHttp::WITH_SSL_DISABLED;
        return $this;
    }

    private function processRequest(): array
    {
        return XMLHttp::request($this->apiUrl, [

        ], RequestBody::from($this->credentials, $this->transactionData),
            $this->withSSLVerification
        );
    }

    public function transactionData(TransactionData $transactionData): self
    {
        $this->transactionData = $transactionData;
        return $this;
    }

    public function withCustomReference(string $reference): self
    {
        $this->transactionData->setReferenceNumber($reference);
        return $this;
    }

    public function useDevApi(string $devApiUrl = self::DEV_API_URL): self
    {

        $this->apiUrl = $devApiUrl;
        return $this;
    }

    public function useProdApi(string $prodApiUrl = self::PROD_API_URL): self
    {
        $this->apiUrl = $prodApiUrl;
        return $this;
    }
}