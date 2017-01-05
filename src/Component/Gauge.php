<?php

namespace Kata\Component;

/**
 * Class Gauge
 *
 * @package Kata
 **/
abstract class Gauge
{
    const MIN_GAUGE_VALUE = 0;
    const INITIAL_GAUGE_VALUE = 5;
    const MAX_GAUGE_VALUE = 10;

    /**
     * @var int
     */
    protected $value;

    /**
     * @var string
     */
    protected $type;

    /**
     * Gauge constructor.
     *
     * @param string $type
     * @param int $value
     */
    public function __construct($type, $value) {
        $this->type = $type;
        $this->value = $value;
    }

    public function increase($value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('The increased value could not be lower than 0');
        }
        $this->value += $value;

        if ($this->value >= Gauge::MAX_GAUGE_VALUE) {
            $this->value = Gauge::MAX_GAUGE_VALUE;
        }
    }

    public function decrease($value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('The decreased value could not be lower than 0');
        }
        $this->value -= $value;

        if ($this->value <= Gauge::MIN_GAUGE_VALUE) {
            $this->value = Gauge::MIN_GAUGE_VALUE;
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
