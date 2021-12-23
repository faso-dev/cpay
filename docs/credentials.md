# Credentials 

This class materializes the connection credentials to the Orange Money api.These identifiers are retrieved from the operator after a contract signature.

## Use case

The arguments of the class are respectively: your ```username``` received by Orange Burkina, the ```password``` and finally the number of the
the acceptor/partner who receives the payment ```merchant_number```.

```php
<?php

use CC\Sdk\Config\Credentials;

$credentials = Credentials::from('username', 'password', 'merchant');

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
