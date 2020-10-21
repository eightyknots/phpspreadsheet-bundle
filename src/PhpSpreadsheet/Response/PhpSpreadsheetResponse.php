<?php

namespace Yectep\PhpSpreadsheetBundle\PhpSpreadsheet\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class PhpSpreadsheetResponse extends Response
{
    public function __construct($content, $fileName, $contentType, $contentDisposition = 'attachment', $status = 200, $headers = [])
    {
        $contentDispositionDirectives = [ResponseHeaderBag::DISPOSITION_INLINE, ResponseHeaderBag::DISPOSITION_ATTACHMENT];
        if (!in_array($contentDisposition, $contentDispositionDirectives)) {
            throw new \InvalidArgumentException(sprintf('Expected one of the following directives: "%s", but "%s" given.', implode('", "', $contentDispositionDirectives), $contentDisposition));
        }

        parent::__construct($content, $status, $headers);
        $this->headers->add(['Content-Type' => $contentType]);
        $this->headers->add(['Content-Disposition' => $this->headers->makeDisposition($contentDisposition, $fileName)]);
    }
}
