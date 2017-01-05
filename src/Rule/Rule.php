<?php

namespace Kata\Rule;

use Kata\Component\Gauge;

/**
 * Class Rule
 *
 * @package Kata\Rule
 **/
interface Rule
{
    /**
     * @param Gauge[] $gauges
     *
     * @return bool
     */
    public function applyRule(array $gauges);
}
