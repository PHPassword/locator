<?php

namespace PHPassword\Locator\Proxy;


use PHPassword\Locator\Facade\EmptyFacade;
use PHPassword\Locator\Facade\FacadeInterface;
use PHPassword\Locator\Factory\EmptyFactory;
use PHPassword\Locator\Factory\FactoryInterface;
use PHPassword\Locator\Locator;

class LocatorProxy implements LocatorProxyInterface
{
    /**
     * @var string
     */
    private static $classNameSchema = '%1$s\\%1$s%2$s';

    /**
     * @var \ArrayObject
     */
    private $searchableNamespaces;

    /**
     * @var string
     */
    private $locateName;

    /**
     * @var Locator
     */
    private $locator;

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var FacadeInterface
     */
    private $facade;

    /**
     * LocatorProxy constructor.
     * @param \ArrayObject $searchableNamespaces
     * @param string $locateName
     * @param Locator $locator
     */
    public function __construct(\ArrayObject $searchableNamespaces, string $locateName, Locator $locator)
    {
        $this->searchableNamespaces = $searchableNamespaces;
        $this->locateName = $locateName;
        $this->locator = $locator;
    }

    /**
     * @return FactoryInterface
     */
    public function factory(): FactoryInterface
    {
        if($this->factory === null) {
            try {
                $className = $this->searchInNamespaces('Factory', FactoryInterface::class);
            } catch (NotFoundException $e) {
                $className = EmptyFactory::class;
            }

            $this->factory = new $className;
            $this->factory->setLocator($this->locator);
        }

        return $this->factory;
    }

    /**
     * @return FacadeInterface
     */
    public function facade(): FacadeInterface
    {
        if($this->facade === null) {
            try {
                $className = $this->searchInNamespaces('Facade', FacadeInterface::class);
            } catch (NotFoundException $e) {
                $className = EmptyFacade::class;
            }

            $this->facade = new $className;
            $this->facade->setLocator($this->locator);
        }

        return $this->facade;
    }

    /**
     * @param string $expectedClassBaseName
     * @param string $expectedInterface
     * @return string
     * @throws NotFoundException
     */
    private function searchInNamespaces(string $expectedClassBaseName, string $expectedInterface)
    {
        foreach($this->searchableNamespaces as $namespace){
            $expectedClassName = $namespace . sprintf(self::$classNameSchema, $this->locateName, $expectedClassBaseName);
            if(class_exists($expectedClassName) === true
                && in_array($expectedInterface, class_implements($expectedClassName))){
                return $expectedClassName;
            }
        }

        throw new NotFoundException(sprintf('Class %s not found in module %s', $expectedClassBaseName, $this->locateName));
    }

}