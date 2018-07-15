<?php

namespace PHPassword\UnitTest\LocatorProxyTest;

use PHPassword\Locator\Factory\FactoryInterface;
use PHPassword\Locator\SetLocatorImplementation;

class LocatorProxyTestFactory implements FactoryInterface
{
    use SetLocatorImplementation;
}