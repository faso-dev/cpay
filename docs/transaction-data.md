# TransactionData 

This class contains information about the user's transaction.

## Use case

The arguments of the class are respectively: ``client_number`` is the phone number of the customer making the payment, ```payment_amount``` is the amount of the payment and finally ```otp``` is the OTP code generated by USSD by the customer.

```php
<?php

use CPay\Sdk\Config\TransactionData;

$transactionData = TransactionData::from("client_number", "payment_amount", "otp_code");

```

## Go back

- [Home](index.md)
