<?php


use PHPassword\Locator\Facade\EmptyFacade;
use PHPassword\Locator\Factory\EmptyFactory;
use PHPassword\Locator\Proxy\LocatorProxy;
use PHPassword\UnitTest\LocatorProxyTest\LocatorProxyTestFacade;
use PHPassword\UnitTest\LocatorProxyTest\LocatorProxyTestFactory;
use PHPUnit\Framework\TestCase;

class LocatorProxyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testEmptyFacade()
    {
        $proxy = new LocatorProxy(new ArrayObject(), 'NoneExistentName');
        $this->assertInstanceOf(EmptyFacade::class, $proxy->facade());
    }

    /**
     * @throws Exception
     */
    public function testEmptyFactory()
    {
        $proxy = new LocatorProxy(new ArrayObject(), 'NoneExistentName');
        $this->assertInstanceOf(EmptyFactory::class, $proxy->factory());
    }

    /**
     * @throws Exception
     */
    public function testFactory()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyTest');
        $this->assertInstanceOf(LocatorProxyTestFactory::class, $proxy->factory());
    }

    /**
     * @throws Exception
     */
    public function testFacade()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyTest');
        $this->assertInstanceOf(LocatorProxyTestFacade::class, $proxy->facade());
    }

    /**
     * @throws Exception
     */
    public function testFactoryMissingInterface()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyFalseTest');
        $this->assertInstanceOf(EmptyFactory::class, $proxy->factory());
    }

    /**
     * @throws Exception
     */
    public function testFacadeMissingInterface()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyFalseTest');
        $this->assertInstanceOf(EmptyFacade::class, $proxy->facade());
    }
}