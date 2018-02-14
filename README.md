# PhpSpreadsheetBundle

This bundle integrates your Symfony 2/3/4 app with the PHPOffice PhpSpreadsheet
productivity library.

## Requirements

This bundle requires, in addition to prerequisites of each PHPOffice library:

    * PHP 5.6 or higher
    * Symfony 2.7, 3.0 or 4.0
    
## Installation

### via composer

Use composer to require the latest stable version.

````bash
$ composer require yectep/phpspreadsheet-bundle
````

Then enable the bundle in your `AppKernel.php` file.

````php
$bundles = array(
    [...]
    new Yectep\PhpSpreadsheetBundle\PhpSpreadsheetBundle(),
);
````