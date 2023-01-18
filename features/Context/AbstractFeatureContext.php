<?php

namespace App\Behat;

use Behat\MinkExtension\Context\RawMinkContext;

abstract class AbstractFeatureContext extends RawMinkContext
{
    public function getJsonResponse(): array
    {
        $response = $this->getSession()->getPage()->getContent();

        return json_decode($response, true);
    }
}
