<?php

namespace PHPassword\Locator\Proxy;

use PHPassword\Locator\Facade\EmptyFacade;
use PHPassword\Locator\Factory\EmptyFactory;
use PHPassword\Locator\Locator;

class LocatorProxyFactory
{
    /**
     * @var \ArrayObject
     */
    private $searchableNamespaces;

    /**
     * LocatorProxyFactory constructor.
     * @param \ArrayObject $searchableNamespaces
     */
    public function __construct(\ArrayObject $searchableNamespaces)
    {
        $this->searchableNamespaces = $searchableNamespaces;
    }

    /**
     * @param string $moduleName
     * @param Locator $locator
     * @return LocatorProxyInterface
     * @throws NotFoundException
     */
    public function create(string $moduleName, Locator $locator) : LocatorProxyInterface
    {
        $proxy = new LocatorProxy($this->searchableNamespaces, $moduleName, $locator);
        if(get_class($proxy->factory()) === EmptyFactory::class
            && get_class($proxy->facade()) === EmptyFacade::class){
            throw new NotFoundException(sprintf('Module %s was not found. You need at least a factory or a facade', $moduleName));
        }

        return $proxy;
    }
}