<?php

namespace PHPassword\Locator;


class LocatorParameter implements LocatorParameterInterface
{
    /**
     * @var array
     */
    private $parameter;

    /**
     * LocatorParameter constructor.
     * @param array $parameter
     */
    public function __construct(array $parameter = [])
    {
        $this->parameter = $parameter;
    }

    /**
     * @param string $index
     * @param mixed $default
     * @return mixed
     */
    public function get(string $index, $default = null)
    {
        return $this->parameter[$index] ?? $default;
    }
}