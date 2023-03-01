# BankID Sweden PHP

BankID Sweden PHP is a PHP Wrapper for [BankID Web service API.](https://www.bankid.com/utvecklare/guider/teknisk-integrationsguide/webbservice-api)
Supports BankID API version 5.1. Requires PHP 7.4 or higher and composer.

> :warning: This project is under development. Released versions will be published on packagist.org

### BankID API Versions support
- v5.1 

### Requirements
* Composer 
* PHP 7.4 or higher
### Installation
Currently, composer package only available by cloning.
```json
    "repositories": [{
        "type": "path",
        "url": "C:\\xampp\\htdocs\\bankid-sweden-php"
    }],
    "require": {
        "hajarrashidi/bankid-sweden-php": "1.*"
    },
```
### Implementation
Create a new instance of BankID class and pass the required parameters.
```php
$bankidClient = new Bankid(Bankid::ENVIRONMENT_TEST, Bankid::API_VERSION_5_1);
$bankid = new BankidService($bankidClient);
```

### Features
- [x] /auth endpoint
- [x] /collect endpoint
- [x] /cancel endpoint
- [x] Support Test environment 
### Todo before release
- [ ] Support Production environment
- [ ] /sign endpoint
- [ ] requirement parametern most be included in auth and sign. 
- [ ] 14.1.2 Additional Parameters for sign
- [ ] 14.1.3 Additional Parameters for auth
- [ ] Add examples for implementing a frontend example
