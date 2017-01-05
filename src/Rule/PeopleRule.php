<?php

namespace Kata\Rule;

use Kata\Component\Gauge;
use Kata\Component\HealthGauge;
use Kata\Component\PeopleGauge;
use Kata\Game;

/**
 * Class PeopleRule
 *
 * @package Kata\Rule
 **/
class PeopleRule implements Rule
{

    const GAUGE_VALUE_CRITICAL = 2;
    const GAUGE_VALUE_URGENT = 4;
    const GAUGE_VALUE_EXCELLENT = 8;

    /**
     * @var \Kata\Component\Gauge
     */
    private $gauge;

    public function __construct(Gauge $gauge)
    {
        $this->gauge = $gauge;
    }

    /**
     * @param Gauge[] $gauges
     *
     * @return bool
     */
    public function applyRule(array $gauges)
    {
        return $this->isGameOver();
    }

    /**
     * @return bool
     */
    private function isGameOver()
    {
        return $this->peopleMakeRevolution() || $this->peopleIsDead();
    }

    /**
     * @return bool
     */
    private function peopleMakeRevolution()
    {
        return $this->gauge->getValue() >= Gauge::MIN_GAUGE_VALUE;
    }

    /**
     * @return bool
     */
    public function peopleIsDead()
    {
        return $this->gauge->getValue() <= Gauge::MIN_GAUGE_VALUE;
    }
}
