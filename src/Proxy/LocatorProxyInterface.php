<?php

namespace PHPassword\Locator\Proxy;


use PHPassword\Locator\Facade\FacadeInterface;
use PHPassword\Locator\Factory\FactoryInterface;

interface LocatorProxyInterface
{
    /**
     * @return FactoryInterface
     */
    public function factory() : FactoryInterface;

    /**
     * @return FacadeInterface
     */
    public function facade() : FacadeInterface;
}