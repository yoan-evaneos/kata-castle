<?php

namespace Kata\Rule;

use Kata\Component\Gauge;
use Kata\Component\HealthGauge;
use Kata\Component\PeopleGauge;
use Kata\Game;

/**
 * Class ArmyRule
 *
 * @package Kata\Rule
 **/
class GoldRule implements Rule
{
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
        return false;
    }
}
