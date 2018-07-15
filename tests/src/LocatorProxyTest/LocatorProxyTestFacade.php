<?php

namespace PHPassword\UnitTest\LocatorProxyTest;


use PHPassword\Locator\Facade\FacadeInterface;
use PHPassword\Locator\SetLocatorImplementation;

class LocatorProxyTestFacade implements FacadeInterface
{
    use SetLocatorImplementation;
}