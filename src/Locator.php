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
     * @var LocatorParameterInterface
     */
    private $parameter;

    /**
     * @var LocatorProxyInterface[]
     */
    private $proxies;

    /**
     * Locator constructor.
     * @param LocatorProxyFactory $factory
     */
    public function __construct(LocatorProxyFactory $factory, LocatorParameterInterface $parameter = null)
    {
        $this->factory = $factory;
        $this->parameter = $parameter ?? new LocatorParameter();
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
            $this->proxies[$moduleName] = $this->factory->create($moduleName, $this);
        }

        return $this->proxies[$moduleName];
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return LocatorProxyInterface
     * @throws Proxy\NotFoundException
     */
    public function __call(string $name, array $arguments)
    {
        return $this->locate(ucfirst($name));
    }

    /**
     * @return LocatorParameterInterface
     */
    public function parameter(): LocatorParameterInterface
    {
        return $this->parameter;
    }
}