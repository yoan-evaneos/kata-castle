<?php

namespace Kata\Component;

/**
 * Class WheatGauge
 *
 * @package Kata\Test
 **/
class WheatGauge extends Gauge
{
    const GAUGE_NAME = 'wheat';

    /**
     * HealthGauge constructor.
     *
     */
    public function __construct()
    {
        parent::__construct(self::GAUGE_NAME, Gauge::INITIAL_GAUGE_VALUE);
    }
}
