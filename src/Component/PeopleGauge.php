<?php

namespace Kata\Component;

/**
 * Class PeopleGauge
 *
 * @package Kata\Test
 **/
class PeopleGauge extends Gauge
{
    const GAUGE_NAME = 'people';

    /**
     * HealthGauge constructor.
     *
     */
    public function __construct()
    {
        parent::__construct(self::GAUGE_NAME, Gauge::INITIAL_GAUGE_VALUE);
    }
}
