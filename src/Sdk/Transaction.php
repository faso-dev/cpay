<?php

namespace CPay\Sdk;

use CPay\Http\RequestBody;
use CPay\Http\XMLHttp;
use CPay\Sdk\Config\Credentials;
use CPay\Sdk\Config\TransactionData;
use CPay\Sdk\Exception\TransactionException;

class Transaction implements TransactionCallableInterface, TransactionHandlerInterface
{
    private const DEV_API_URL = "https://testom.orange.bf:9008/payment";
    private const PROD_API_URL = "https://apiom.orange.bf:9007/payment";

    protected string $apiUrl;

    protected TransactionData $transactionData;

    protected bool $withSSLVerification = XMLHttp::WITH_SSL_ENABLED;

    /**
     * @param Credentials $credentials
     */
    public function __construct(protected Credentials $credentials)
    {
        $this->useDevApi();
    }

    /**
     * @param callable $success
     * @param callable $error
     * @return mixed
     */
    public function on(callable $success, callable $error): mixed
    {
        /**
         * @var $errno int
         * @var $error string
         * @var $response mixed
         */
        [$errno, $errorMessage, $response] = $this->processRequest();
        if ($errno > 0) {
            return $error($errorMessage, $errno);
        }

        $response = TransactionResponse::fromXMLResponse($response);

        if ($response->getStatus() !== 200) {
            return $error($response->getMessage(), $response->getStatus());
        }

        return $success($response);
    }

    /**
     * @throws TransactionException
     */
    public function handleTransaction(): TransactionResponse
    {
        /**
         * @var $errno int
         * @var $errorMessage string
         * @var $response mixed
         */
        [$errno, $errorMessage, $response] = $this->processRequest();
        if ($errno > 0) {
            throw new TransactionException($errorMessage, $errno);
        }
        
        $response = TransactionResponse::fromXMLResponse($response);

        if ($response->getStatus() !== 200) {
            throw new TransactionException($response->getMessage(), $response->getStatus());
        }

        return $response;
    }

    /**
     * @return $this
     */
    public function withoutSSLVerification(): self
    {
        $this->withSSLVerification = XMLHttp::WITH_SSL_DISABLED;
        return $this;
    }

    /**
     * @return array
     */
    private function processRequest(): array
    {
        return XMLHttp::request($this->apiUrl, [

        ], RequestBody::from($this->credentials, $this->transactionData),
            $this->withSSLVerification
        );
    }

    /**
     * @param TransactionData $transactionData
     * @return $this
     */
    public function withTransactionData(TransactionData $transactionData): self
    {
        $this->transactionData = $transactionData;
        return $this;
    }

    /**
     * @param string $reference
     * @return $this
     */
    public function withCustomReference(string $reference): self
    {
        $this->transactionData->setReferenceNumber($reference);
        return $this;
    }

    /**
     * @param string $devApiUrl
     * @return $this
     */
    public function useDevApi(string $devApiUrl = self::DEV_API_URL): self
    {

        $this->apiUrl = $devApiUrl;
        return $this;
    }

    /**
     * @param string $prodApiUrl
     * @return $this
     */
    public function useProdApi(string $prodApiUrl = self::PROD_API_URL): self
    {
        $this->apiUrl = $prodApiUrl;
        return $this;
    }
}