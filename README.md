# BankID PHP
**BankID PHP** is a PHP library for the [BankID Web service API.](https://www.bankid.com/utvecklare/guider/teknisk-integrationsguide/webbservice-api)
## Version
Alpha 0.1
## Requirements
* Composer 
## Installation
Currently not available on packagist.org


## local development 
If you want to contribute to this project, you can clone this repository and use it as a local package.
1. Clone this repository
2. Add this to your composer.json file
```json
"repositories": [{
    "type": "path",
     "url": "C:\\xampp\\htdocs\\bankid-php"
}],
"require": {
    "hajarrashidi/bankid-php": "1.*"
},,
```
3. Make sure `url` is correct
4. Run `composer update`
5. Example of use 
```php
    $bankid = new \BankID\BankID();
    echo $bankid->test();
    // Output "I am BankID PHP"
   ```