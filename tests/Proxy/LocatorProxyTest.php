<?php


use PHPassword\Locator\Facade\EmptyFacade;
use PHPassword\Locator\Factory\EmptyFactory;
use PHPassword\Locator\Locator;
use PHPassword\Locator\Proxy\LocatorProxy;
use PHPassword\Locator\Proxy\LocatorProxyFactory;
use PHPassword\UnitTest\LocatorProxyTest\LocatorProxyTestFacade;
use PHPassword\UnitTest\LocatorProxyTest\LocatorProxyTestFactory;
use PHPUnit\Framework\TestCase;

class LocatorProxyTest extends TestCase
{
    /**
     * @var Locator
     */
    private static $locator;

    public static function setUpBeforeClass()
    {
        $factory = new LocatorProxyFactory(new ArrayObject(['PHPassword\\UnitTest\\']));
        self::$locator = new Locator($factory);
    }

    /**
     * @throws Exception
     */
    public function testEmptyFacade()
    {
        $proxy = new LocatorProxy(new ArrayObject(), 'NoneExistentName', self::$locator);
        $this->assertInstanceOf(EmptyFacade::class, $proxy->facade());
    }

    /**
     * @throws Exception
     */
    public function testEmptyFactory()
    {
        $proxy = new LocatorProxy(new ArrayObject(), 'NoneExistentName', self::$locator);
        $this->assertInstanceOf(EmptyFactory::class, $proxy->factory());
    }

    /**
     * @throws Exception
     */
    public function testFactory()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyTest', self::$locator);
        $this->assertInstanceOf(LocatorProxyTestFactory::class, $proxy->factory());
    }

    /**
     * @throws Exception
     */
    public function testFacade()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyTest', self::$locator);
        $this->assertInstanceOf(LocatorProxyTestFacade::class, $proxy->facade());
    }

    /**
     * @throws Exception
     */
    public function testFactoryMissingInterface()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyFalseTest', self::$locator);
        $this->assertInstanceOf(EmptyFactory::class, $proxy->factory());
    }

    /**
     * @throws Exception
     */
    public function testFacadeMissingInterface()
    {
        $proxy = new LocatorProxy(new ArrayObject(['PHPassword\\UnitTest\\']), 'LocatorProxyFalseTest', self::$locator);
        $this->assertInstanceOf(EmptyFacade::class, $proxy->facade());
    }
}