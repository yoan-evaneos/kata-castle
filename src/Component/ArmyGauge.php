<?php

namespace Kata\Component;

/**
 * Class ArmyGauge
 *
 * @package Kata\Test
 **/
class ArmyGauge extends Gauge
{
    const GAUGE_NAME = 'army';

    /**
     * HealthGauge constructor.
     *
     */
    public function __construct()
    {
        parent::__construct(self::GAUGE_NAME, Gauge::INITIAL_GAUGE_VALUE);
    }
}
