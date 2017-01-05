<?php

namespace Kata\Rule;

use Kata\Component\Gauge;
use Kata\Component\HealthGauge;
use Kata\Component\PeopleGauge;
use Kata\Game;

/**
 * Class WheatRule
 *
 * @package Kata\Rule
 **/
class WheatRule implements Rule
{

    const GAUGE_VALUE_CRITICAL = 1;
    const GAUGE_VALUE_URGENT = 3;
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
        $healthGauge = $gauges[HealthGauge::GAUGE_NAME];
        switch (true) {
            case $this->isCritical():
                $healthGauge->decrease(2);
                break;
            case $this->isUrgent():
                $healthGauge->decrease(1);
                break;
            case $this->isExcellent():
                $healthGauge->increase(1);
                break;
        }

        return $this->isGameOver();
    }

    /**
     * @return bool
     */
    private function isCritical()
    {
        return $this->gauge->getValue() < self::GAUGE_VALUE_CRITICAL;
    }

    /**
     * @return bool
     */
    private function isUrgent()
    {
        return $this->gauge->getValue() < self::GAUGE_VALUE_URGENT;
    }

    /**
     * @return bool
     */
    private function isExcellent()
    {
        return $this->gauge->getValue() > self::GAUGE_VALUE_EXCELLENT;
    }

    /**
     * @return bool
     */
    private function isGameOver()
    {
        return false;
    }
}
