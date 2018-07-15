<?php

namespace PHPassword\Locator;


interface LocatorAwareInterface
{
    /**
     * @param Locator $locator
     */
    public function setLocator(Locator $locator);
}