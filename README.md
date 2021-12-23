# CPAY 

CPAY est un sdk qui encapsuble l'api de Orange Money avec une syntaxe intuitive vous permettant d'intégrer le paiement par Orange Money dans votre projet PHP.

## Installation via composer

```shell
composer require choco-code/cpay
```

## Cas d'utilisation

```php
<?php
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
