# BankID Sweden PHP

BankID Sweden PHP is a PHP Wrapper for [BankID Web service API.](https://www.bankid.com/utvecklare/guider/teknisk-integrationsguide/webbservice-api)
Supports BankID API version 5.1. Requires PHP 7.4 or higher and composer.

``This project is under development. Released versions will be published on packagist.org``

## BankID API Versions support
- https://appapi2.bankid.com/rp/v5.1

## Requirements
* Composer 
* PHP 7.4 or higher
## Installation
Currently not available on packagist.org
# Features
- [x] /auth endpoint
- [x] /collect endpoint
- [x] /cancel endpoint
- 
## local development 
If you want to contribute to this project, you can clone this repository and use it as a local package.
1. Clone this repository
2. Add this to your composer.json file
```json
"repositories": [{
    "type": "path",
     "url": "C:\\xampp\\htdocs\\bankid-sweden-php"
}],
"require": {
    "hajarrashidi/bankid-sweden-php": "1.*"
},,
```
3. Make sure `url` is correct
4. Run `composer update`
5. Example of use 
```php

   ```
 