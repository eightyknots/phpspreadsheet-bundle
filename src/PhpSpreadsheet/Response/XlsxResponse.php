<?php

namespace Yectep\PhpSpreadsheetBundle\PhpSpreadsheet\Response;

class XlsxResponse extends PhpSpreadsheetResponse
{
    public function __construct($content, $fileName = 'output.xlsx', $contentType = 'text/x-csv; charset=windows-1251', $contentDisposition = 'attachment', $status = 200, $headers = [])
    {
        parent::__construct($content, $fileName, $contentType, $contentDisposition, $status, $headers);
    }
}
