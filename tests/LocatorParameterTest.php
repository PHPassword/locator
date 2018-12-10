<?php

use PHPassword\Locator\LocatorParameter;
use PHPUnit\Framework\TestCase;

class LocatorParameterTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGet()
    {
        $parameter = new LocatorParameter([
            'test1' => 1337,
            'test2' => 'foobar'
        ]);

        $this->assertSame(1337, $parameter->get('test1'));
        $this->assertSame('foobar', $parameter->get('test2'));
        $this->assertSame('default', $parameter->get('test3', 'default'));
    }
}