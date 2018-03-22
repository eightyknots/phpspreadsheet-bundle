# PhpSpreadsheetBundle

This bundle integrates your Symfony 2/3/4 app with the PHPOffice PhpSpreadsheet
productivity library.

## Requirements

This bundle requires, in addition to prerequisites of each PHPOffice library:

    * PHP 5.6 or higher
    * Symfony 2.7, 3.0 or 4.0
    
## Installation

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

## Usage

This bundle enables the `phpoffice.spreadsheet` service.

See also the official [PHPOffice PhpSpreadsheet documentation](http://phpspreadsheet.readthedocs.io/).

### createSpreadsheet()

Creates an empty `\PhpOffice\PhpSpreadsheet\Spreadsheet` object, or, if an optional 
`$filename` is passed, instantiates the `\PhpOffice\PhpSpreadsheet\IOFactory` to
automatically detect and use the appropriate `IWriter` class to read the file.

````php
// In your controller
$newSpreadsheet = $this->get('phpoffice.spreadsheet')->createSpreadsheet();
$existingXlsx   = $this->get('phpoffice.spreadsheet')->createSpreadsheet('/path/to/file.xlsx');
````

### createReader(`string` $type)

Returns an instance of the `\PhpOffice\PhpSpreadsheet\Reader` class of the given `$type`.

Types are case sensitive. Supported types are:

* `Xlsx`: Excel 2007
* `Xls`: Excel 5/BIFF (95)
* `Xml`: Excel 2003 XML
* `Slk`: Symbolic Link (SYLK)
* `Ods`: Open/Libre Office (ODS)
* `Csv`: CSV
* `Html`: HTML

````php
$readerXlsx  = $this->get('phpoffice.spreadsheet')->createReader('Xlsx');
$spreadsheet = $readerXlsx->load('/path/to/file.xlsx');
````

### createWriter(`Spreadsheet` $spreadsheet, `string` $type)

Given a `\PhpOffice\PhpSpreadsheet\Spreadsheet` object and a writer `$type`, returns
an instance of a `\PhpOffice\PhpSpreadsheet\Writer` class for that type.

In addition the the read types above, these types are additionally supported for writing, if
the appropriate PHP libraries are installed.

* `Tcpdf`
* `Mpdf`
* `Dompdf`

````php
$spreadsheet = $this->get('phpoffice.spreadsheet')->createSpreadsheet();
$spreadsheet->getActiveSheet()->setCellValue('A1', 'Hello world');

$writerXlsx = $this->get('phpoffice.spreadsheet')->createWriter($spreadsheet, 'Xlsx');
$writerXlsx->save('/path/to/destination.xlsx');
````

## Roadmap and Contributions

Contributions are more than welcome. Fork the project, and submit a PR when you're done.

Remaining todos include:

* Tests and test coverage
* TravisCI
* Improved documentation
