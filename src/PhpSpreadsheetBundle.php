<?php

namespace Yectep\PhpSpreadsheetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Yectep\PhpSpreadsheetBundle\DependencyInjection\PhpSpreadsheetExtension;

class PhpSpreadsheetBundle extends Bundle
{

    /**
     * @inheritdoc
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new PhpSpreadsheetExtension();
    }

}
