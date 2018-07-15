<?php

use PHPassword\Locator\Locator;
use PHPassword\Locator\Proxy\LocatorProxyFactory;
use PHPassword\Locator\Proxy\LocatorProxyInterface;
use PHPassword\Locator\Proxy\NotFoundException;
use PHPUnit\Framework\TestCase;

class LocatorProxyFactoryTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreate()
    {
        $factory = new LocatorProxyFactory(new ArrayObject(['PHPassword\\UnitTest\\']));
        $this->assertInstanceOf(LocatorProxyInterface::class, $factory->create('LocatorProxyTest', new Locator($factory)));
    }

    /**
     * @throws Exception
     */
    public function testCreateFail()
    {
        $factory = new LocatorProxyFactory(new ArrayObject(['PHPassword\\UnitTest\\']));
        $this->expectException(NotFoundException::class);
        $this->assertInstanceOf(LocatorProxyInterface::class, $factory->create('NonExistent', new Locator($factory)));
    }
}