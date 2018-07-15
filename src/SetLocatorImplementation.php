<?php

namespace PHPassword\Locator;


trait SetLocatorImplementation
{
    /**
     * @var Locator
     */
    private $locator;

    /**
     * @param Locator $locator
     */
    public function setLocator(Locator $locator)
    {
        $this->locator = $locator;
    }
}