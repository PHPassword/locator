<?php

namespace PHPassword\Locator;

use PHPassword\Locator\Proxy\LocatorProxyFactory;
use PHPassword\Locator\Proxy\LocatorProxyInterface;

class Locator
{
    /**
     * @var LocatorProxyFactory
     */
    private $factory;

    /**
     * @var LocatorProxyInterface[]
     */
    private $proxies;

    /**
     * Locator constructor.
     * @param LocatorProxyFactory $factory
     */
    public function __construct(LocatorProxyFactory $factory)
    {
        $this->factory = $factory;
        $this->proxies = [];
    }

    /**
     * @param string $moduleName
     * @return LocatorProxyInterface
     * @throws Proxy\NotFoundException
     */
    public function locate(string $moduleName) : LocatorProxyInterface
    {
        if(!isset($this->proxies[$moduleName])){
            $this->proxies[$moduleName] = $this->factory->create($moduleName);
        }

        return $this->proxies[$moduleName];
    }
}