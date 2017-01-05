<?php

namespace Kata\Rule;

use Kata\Component\Gauge;
use Kata\Component\HealthGauge;
use Kata\Component\PeopleGauge;
use Kata\Game;

/**
 * Class HealthRule
 *
 * @package Kata\Rule
 **/
class HealthRule implements Rule
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
        $peopleGauge = $gauges[PeopleGauge::GAUGE_NAME];
        switch (true) {
            case $this->isCritical():
                $peopleGauge->decrease(2);
                break;
            case $this->isUrgent():
                $peopleGauge->decrease(1);
                break;
            case $this->isExcellent():
                $peopleGauge->increase(1);
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

    private function isGameOver()
    {
        return false;
    }
}
