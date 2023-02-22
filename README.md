# BankID Sweden PHP

BankID Sweden PHP is a PHP Wrapper for [BankID Web service API.](https://www.bankid.com/utvecklare/guider/teknisk-integrationsguide/webbservice-api)
Supports BankID API version 5.1. Requires PHP 7.4 or higher and composer.

> :warning: This project is under development. Released versions will be published on packagist.org

## BankID API Versions support
- https://appapi2.bankid.com/rp/v5.1

## Requirements
* Composer 
* PHP 7.4 or higher
## Installation
Currently composer package only available by cloning.
```json
    "repositories": [{
        "type": "path",
        "url": "C:\\xampp\\htdocs\\bankid-sweden-php"
    }],
    "require": {
        "hajarrashidi/bankid-sweden-php": "1.*"
    },
```
# Features
- [x] /auth endpoint
- [x] /collect endpoint
- [x] /cancel endpoint
