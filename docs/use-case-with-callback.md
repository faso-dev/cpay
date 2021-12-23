## Use case with callback to handle success or error response

Update to the path of your composer auto-load.
If you are using this package in Laravel or Symfony or any other Framework or Project that already required the composer auto-load, you can remove this line : ```require_once __DIR__ . '/vendor/autoload.php';```  in the example below

```php

<?php

use CC\Sdk\Config\Credentials;
use CC\Sdk\Config\TransactionData;
use CC\Sdk\CPay;
use CC\Sdk\TransactionResponse;

require_once __DIR__ . '/vendor/autoload.php';

CPay::initWithCredentials(Credentials::from('username', 'password', 'merchant_number'))
    ->transactionData(TransactionData::from("client_number", "payment_amount", "otp_code"))
    ->withCustomReference("145278945343965") //optionnal
    ->useProdApi() //for production
    ->withoutSSLVerification() //Disable SSL verification(not recommended).
    ->submit(
        onSuccess: function (TransactionResponse $response) {
            echo 'Thank you for your purchasse !';
            echo $response->getTransactionId();
        },

        onError: function (string $message, int $errorCode) {
            echo "Whoops! Unable to process payment. <br/> 
                    Error message returned by request: {$message}. <br/>
                     Error code returned by request: {$errorCode}";
        }
    );

```
## Go back

- [Home](index.md) 