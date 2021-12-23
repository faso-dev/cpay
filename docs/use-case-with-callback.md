## Use case with callback to handle success or error response

Update to the path of your composer auto-load. If you are using this package in Laravel or Symfony or any other
Framework or Project that already required the composer auto-load, you can remove this
line : ```require_once __DIR__ . '/vendor/autoload.php';```  in the example below

```php

<?php

use CPay\Sdk\Config\Credentials;
use CPay\Sdk\Config\TransactionData;
use CPay\Sdk\Payment;
use CPay\Sdk\Exception\TransactionException;
use CPay\Sdk\TransactionResponse;

require_once __DIR__ . '/vendor/autoload.php';

Payment::initWithCredentials(Credentials::from("username", "password", "merchant_number"))
    ->withTransactionData(TransactionData::from("client_number", "payment_amount", "otp_code"))
    ->withCustomReference("145278945343965") //optionnal
    ->useProdApi() // for production
    ->withoutSSLVerification() // if you have any troubleshoot with ssl verifcation(not recommended)
    ->on(
    
        function (TransactionResponse $response) {
            echo 'Thank you for your purchasse !';
            echo $response->getTransactionId();
        },
        
        function (string $message, int $errorCode) {
            echo "Whoops! Unable to process payment. <br/> 
                    Error message returned by request: {$message}. <br/>
                     Error code returned by request: {$errorCode}";
        }
    );

```

## Go back

- [Home](index.md) 