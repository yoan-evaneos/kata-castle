<?php

namespace Kata\Component;

/**
 * Class GoldGauge
 *
 * @package Kata\Test
 **/
class GoldGauge extends Gauge
{
    const GAUGE_NAME = 'gold';

    /**
     * HealthGauge constructor.
     *
     */
    public function __construct()
    {
        parent::__construct(self::GAUGE_NAME, Gauge::INITIAL_GAUGE_VALUE);
    }
}
