<?php

namespace Yectep\PhpSpreadsheetBundle;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\BaseWriter;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
    public function createSpreadsheet($filename = null): Spreadsheet
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
    public function createWriter(Spreadsheet $spreadsheet, $type): IWriter
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


    /**
     * Return a StreamedResponse containing the file
     * 
     * @param Spreadsheet $spreadsheet
     * @param string $type
     * @param int $status
     * @param array $headers
     * @param array $writerOptions
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function createStreamedResponse(Spreadsheet $spreadsheet, $type, $status = 200, $headers = array(), $writerOptions = array()): StreamedResponse
    {
        $writer = IOFactory::createWriter($spreadsheet, $type);

        if (!empty($writerOptions)) {
            $this->applyOptionsToWriter($writer, $writerOptions);
        }

        return new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $status,
            $headers
        );
    }

    /**
     * @param BaseWriter $writer
     * @param array      $options
     */
    private function applyOptionsToWriter(BaseWriter $writer, $options = array())
    {
        foreach ($options as $method => $arguments) {
            if (method_exists($writer, $method)) {
                if (!is_array($arguments)) {
                    $arguments = array($arguments);
                }
                call_user_func_array(array($writer, $method), $arguments);
            }
        }
    }
}
