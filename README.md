# CPAY 

CPAY is a sdk that encapsulates the Orange Money api with an intuitive syntax allowing you to integrate the Orange Money payment into your PHP project.

## Documentation

[See documentation](docs/index.md)

## Installation

```shell
composer require choco-code/cpay
```

## Use case

Update to the path of your composer auto-load.
If you are using this package in Laravel or Symfony or any other Framework or Project that already required the composer auto-load, you can remove this line : ```require_once __DIR__ . '/vendor/autoload.php';```  in the example below

```php

<?php

use CC\Sdk\Config\Credentials;
use CC\Sdk\Config\TransactionData;
use CC\Sdk\CPay;
use CC\Sdk\TransactionResponse;

require_once __DIR__ . '/vendor/autoload.php';

CPay::initWithCredentials(Credentials::from('DECLICSARL', 'DECLIC@47', '06363737'))
    ->transactionData(TransactionData::from("06373838", "10000", "123456"))
    ->withCustomReference("145278945343965")
    ->useDevApi()
    ->withoutSSLVerification()
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
