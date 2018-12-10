<?php

namespace PHPassword\Locator;

interface LocatorParameterInterface
{
    /**
     * @param string $index
     * @param mixed $default
     * @return mixed
     */
    public function get(string $index, $default = null);
}