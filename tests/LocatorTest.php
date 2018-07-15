<?php


use PHPassword\Locator\Locator;
use PHPassword\Locator\Proxy\LocatorProxyFactory;
use PHPassword\Locator\Proxy\LocatorProxyInterface;
use PHPassword\Locator\Proxy\NotFoundException;
use PHPUnit\Framework\TestCase;

class LocatorTest extends TestCase
{
    /**
     * @var Locator
     */
    private static $locator;

    public static function setUpBeforeClass()
    {
        $factory = new LocatorProxyFactory(new ArrayObject(['PHPassword\\UnitTest\\']));
        static::$locator = new Locator($factory);
    }

    /**
     * @throws Exception
     */
    public function testLocate()
    {
        $this->assertInstanceOf(LocatorProxyInterface::class, static::$locator->locate('LocatorProxyTest'));
    }

    /**
     * @throws Exception
     */
    public function testLocateFail()
    {
        $this->expectException(NotFoundException::class);
        static::$locator->locate('NonExistent');
    }

    /**
     * @throws Exception
     */
    public function testCall()
    {
        $this->assertInstanceOf(LocatorProxyInterface::class, static::$locator->locatorProxyTest());
    }

    /**
     * @throws Exception
     */
    public function testCallFail()
    {
        $this->expectException(NotFoundException::class);
        static::$locator->nonExistent();
    }
}