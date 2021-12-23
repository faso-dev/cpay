## Use case with try catch to handle success or error response

Update to the path of your composer auto-load. If you are using this package in Laravel or Symfony or any other
Framework or Project that already required the composer auto-load, you can remove this
line : ```require_once __DIR__ . '/vendor/autoload.php';```  in the example below

```php

<?php

use CC\Sdk\Config\Credentials;
use CC\Sdk\Config\TransactionData;
use CC\Sdk\Payment;
use CC\Sdk\Exception\TransactionException;
use CC\Sdk\TransactionResponse;

try {
    $response = Payment::initWithCredentials(Credentials::from("username", "password", "merchant_number"))
                        ->withTransactionData(TransactionData::from("client_number", "payment_amount", "otp_code"))
                        ->withCustomReference("145278945343965") //optionnal
                        ->useProdApi() // for production
                        ->withoutSSLVerification() // if you have any troubleshoot with ssl verifcation(not recommended)
                        ->handleTransaction();
                        
    echo 'Thank you for your purchasse !';
    echo $response->getTransactionId();
    
} catch (TransactionException $exception) {
    echo "Whoops! Unable to process payment. <br/> 
          Error message returned by request: {$exception->getMessage()}. <br/>
          Error code returned by request: {$exception->getCode()}";
}

```
## Go back

- [Home](index.md) 