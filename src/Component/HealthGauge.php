<?php

namespace Kata\Component;

/**
 * Class HealthGauge
 *
 * @package Kata\Test
 **/
class HealthGauge extends Gauge
{
    const GAUGE_NAME = 'health';

    /**
     * HealthGauge constructor.
     *
     */
    public function __construct()
    {
        parent::__construct(self::GAUGE_NAME, Gauge::INITIAL_GAUGE_VALUE);
    }
}
