# IPSP PHP-SDK-v2

## Payment service provider
A payment service provider (PSP) offers shops online services for accepting electronic payments by a variety of payment methods including credit card, bank-based payments such as direct debit, bank transfer, and real-time bank transfer based on online banking. Typically, they use a software as a service model and form a single payment gateway for their clients (merchants) to multiple payment methods. 
[read more](https://en.wikipedia.org/wiki/Payment_service_provider)

## Installation
#### Composer Install
```cmd
composer require cloudipsp/php-sdk-v2
```
#### Manual installation
```cmd
git clone -b maseter https://github.com/dimoncheg12/php-sdk-v2.git
```
//ToDo Manual Class loader
## Simple Start
```php
require 'vendor/autoload.php';
\Cloudipsp\Configuration::setMerchantId(1396424);
\Cloudipsp\Configuration::setSecretKey('test');

$checkoutData = [
    'currency' => 'USD',
    'amount' => 1000
];
$data = \Cloudipsp\Checkout::url($data);
$url = $data->getUrl();
//$data->toCheckout() - redirect to checkout
```
# Api

See [php-docs](https://dimoncheg12.github.io/php-docs/)
## Examples
To check it you can use build-in php server
```cmd
cd ~/php-sdk-v2
php -S localhost:8000
```
[Checkout examples](https://github.com/dimoncheg12/php-sdk-v2/tree/master/examples)