<?php

namespace Yectep\PhpSpreadsheetBundle;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Factory class for PhpSpreadsheet objects.
 *
 * @package Yectep\PhpSpreadsheetBundle
 */
class Factory {

    /**
     * Returns a new instance of the PhpSpreadsheet class.
     *
     * @param null|string $filename     If set, uses the IOFactory to return the spreadsheet located at $filename
     *                                  using automatic type resolution per \PhpOffice\PhpSpreadsheet\IOFactory.
     *
     * @return Spreadsheet
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function createSpreadsheet($filename = null)
    {
        return (is_null($filename) ? new Spreadsheet() : IOFactory::load($filename));
    }

    /**
     * Returns the PhpSpreadsheet IWriter instance to save a file.
     *
     * @param Spreadsheet $spreadsheet
     * @param             $type
     *
     * @return \PhpOffice\PhpSpreadsheet\Writer\IWriter
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function createWriter(Spreadsheet $spreadsheet, $type)
    {
        return IOFactory::createWriter($spreadsheet, $type);
    }

    /**
     * @param string    $type   Reader class to create.
     *
     * @return mixed            Returns a IReader of the given type if found.
     * @throws \InvalidArgumentException
     */
    public function createReader($type)
    {
        $readerClass = '\\PhpOffice\\PhpSpreadsheet\\Reader\\' . $type;
        if (!class_exists($readerClass)) {
            throw new \InvalidArgumentException('The reader [' . $type . '] does not exist or is not supported by PhpSpreadsheet.');
        }

        return new $readerClass();
    }

}