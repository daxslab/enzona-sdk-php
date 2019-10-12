# Unofficial PHP SDK for EnZona

<aside class="warning">
This is a work in progress, there are rough corners and the 
API can change witouth previuos warnings. 
Not recommended for production use.
</aside>

This is a PHP library that allows interaction with 
[EnZona's API](https://api.enzona.net).

## Requeriments

PHP 5.5 and later but using the latest version of PHP is highly 
recommended and must be installed the following PHP extensions:

- curl
- json
- mbstring

## Installation & Usage

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/daxslab/enzona-sdk-php.git"
    }
  ],
  "require": {
    "daxslab/enzona-sdk": "*@dev"
  }
}
```

Then run `composer install`

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Creates an API instance
$paymentsAPI = new daxslab\enzona\PaymentAPI();

// Configure OAuth2 access token for authorization: default
$paymentsAPI->setAccessToken('YOUR_ACCESS_TOKEN');

// creates an api endpoint object
$apiObject = $paymentsAPI->listRefundsPayment();

// define parameters
$transaction_uuid = "transaction_uuid_example"; // string | 
$limit = "limit_example"; // string | 
$offset = "offset_example"; // string | 
$status_filter = "status_filter_example"; // string | 
$start_date_filter = "start_date_filter_example"; // string | 
$end_date_filter = "end_date_filter_example"; // string | 
$order_filter = "order_filter_example"; // string | 

// call endpoint
try {
    $result = $apiObject->paymentsTransactionUuidRefundsGet($transaction_uuid, $limit, $offset, $status_filter, $start_date_filter, $end_date_filter, $order_filter);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling $apiObject->paymentsTransactionUuidRefundsGet: ', $e->getMessage(), PHP_EOL;
}

?>
```
