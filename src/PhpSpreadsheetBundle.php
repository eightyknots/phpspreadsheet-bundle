<?php

namespace Yectep\PhpSpreadsheetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Yectep\PhpSpreadsheetBundle\DependencyInjection\PhpSpreadsheetExtension;

class PhpSpreadsheetBundle extends Bundle
{

    /**
     * @inheritdoc
     */
    public function getContainerExtension()
    {
        return new PhpSpreadsheetExtension();
    }

}
