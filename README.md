# CPAY 

CPAY is a sdk that encapsulates the Orange Money api with an intuitive syntax allowing you to integrate the Orange Money payment into your PHP project.

## Installation

```shell
composer require choco-code/cpay
```

## Use case

Update to the path of your composer auto-load.
If you are using this package in Laravel or Symfony or any other Framework or Project that already required the composer auto-load, you can remove this line : ```require_once __DIR__ . '/vendor/autoload.php'; ``` in the example below

```php
<?php
use CC\Sdk\Config\Credentials;
use CC\Sdk\Config\TransactionData;
use CC\Sdk\CPay;

require_once __DIR__ . '/vendor/autoload.php'; //Update to the path of your composer auto-load or remove this line

CPay::initWithCredentials(Credentials::from('username', 'password', 'merchant'))
    ->transactionData(TransactionData::from("clientNumber", "amount", "otp"))
    ->withCustomReference("145278945343965") //optionnal
    ->useProdApi() //for production
    ->withoutSSLVerification() //Disables SSL verification.
    ->submit(
        onSuccess: function (mixed $response) {
            echo 'Thank you for your purchasse !';
            echo $response;
        }, //if the request is successful, this function will be called

        onError: function (string $message, int $errorCode) {
            echo "Whoops! Unable to process payment. <br/> 
                    Error message returned by request: {$message}. <br/>
                     Error code returned by request: {$errorCode}";
        }//if the request results in an error, this function will be called
    );

```

## Testing

Exécutez les tests avec:

```bash
vendor/bin/phpunit
```

ou

```bash
composer tests
```


## Authors

- https://github.com/faso-dev 
- https://github.com/yenteck 

Merci de contribuer !
