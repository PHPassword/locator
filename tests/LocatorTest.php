<?php


use PHPassword\Locator\Locator;
use PHPassword\Locator\Proxy\LocatorProxyFactory;
use PHPassword\Locator\Proxy\LocatorProxyInterface;
use PHPassword\Locator\Proxy\NotFoundException;
use PHPUnit\Framework\TestCase;

class LocatorTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testLocate()
    {
        $factory = new LocatorProxyFactory(new ArrayObject(['PHPassword\\UnitTest\\']));
        $locator = new Locator($factory);

        $this->assertInstanceOf(LocatorProxyInterface::class, $locator->locate('LocatorProxyTest'));
    }

    /**
     * @throws Exception
     */
    public function testLocateFail()
    {
        $factory = new LocatorProxyFactory(new ArrayObject(['PHPassword\\UnitTest\\']));
        $locator = new Locator($factory);

        $this->expectException(NotFoundException::class);
        $locator->locate('NonExistent');
    }
}