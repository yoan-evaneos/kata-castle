<?php

namespace Kata;

use Kata\Component\ArmyGauge;
use Kata\Component\Gauge;
use Kata\Component\GoldGauge;
use Kata\Component\HealthGauge;
use Kata\Component\PeopleGauge;
use Kata\Component\WheatGauge;
use Kata\Rule\ArmyRule;
use Kata\Rule\GoldRule;
use Kata\Rule\HealthRule;
use Kata\Rule\PeopleRule;
use Kata\Rule\Rule;
use Kata\Rule\WheatRule;

/**
 * Class Game
 *
 * @package Kata
 **/
class Game
{
    const DICE_WHEAT = 1;
    const DICE_TRADE = 2;
    const DICE_PLAGUE_FACE_ONE = 3;
    const DICE_PLAGUE_FACE_TWO = 4;
    const DICE_HAIL = 5;
    const DICE_MEDICINE = 6;

    /**
     * @var Gauge[]
     */
    private $gauges;

    /**
     * @var Rule[]
     */
    private $rules;

    public function __construct()
    {
        $this->initGauges();
        $this->initRules();
    }


    /**
     *
     */
    public function play()
    {
        $diceValue = rand(1, 6);
        $this->applyDiceResult($diceValue);

        if ($this->isGameOver()) {
            throw new \Exception('Game Over');
        }
    }

    /**
     * initialize Gauges
     */
    private function initGauges()
    {
        $this->gauges = [
            ArmyGauge::GAUGE_NAME => new ArmyGauge(),
            GoldGauge::GAUGE_NAME => new GoldGauge(),
            HealthGauge::GAUGE_NAME => new HealthGauge(),
            PeopleGauge::GAUGE_NAME => new PeopleGauge(),
            WheatGauge::GAUGE_NAME => new WheatGauge(),
        ];
    }

    /**
     * initialize Rules
     */
    private function initRules()
    {
        $this->rules = [
            ArmyGauge::GAUGE_NAME => new ArmyRule($this->gauges[ArmyGauge::GAUGE_NAME]),
            GoldGauge::GAUGE_NAME => new GoldRule($this->gauges[GoldGauge::GAUGE_NAME]),
            HealthGauge::GAUGE_NAME => new HealthRule($this->gauges[HealthGauge::GAUGE_NAME]),
            PeopleGauge::GAUGE_NAME => new PeopleRule($this->gauges[PeopleGauge::GAUGE_NAME]),
            WheatGauge::GAUGE_NAME => new WheatRule($this->gauges[WheatGauge::GAUGE_NAME]),
        ];
    }

    /**
     * @param $diceValue
     */
    private function applyDiceResult($diceValue)
    {
        switch ($diceValue) {
            case self::DICE_WHEAT:
                $this->gauges[WheatGauge::GAUGE_NAME]->increase(1);
                break;
            case self::DICE_TRADE:
                $this->gauges[GoldGauge::GAUGE_NAME]->increase(1);
                break;
            case self::DICE_PLAGUE_FACE_ONE:
            case self::DICE_PLAGUE_FACE_TWO:
                $this->gauges[HealthGauge::GAUGE_NAME]->decrease(1);
                break;
            case self::DICE_HAIL:
                $this->gauges[WheatGauge::GAUGE_NAME]->decrease(1);
                break;
            case self::DICE_MEDICINE:
                $this->gauges[HealthGauge::GAUGE_NAME]->increase(1);
                break;
        }
    }

    /**
     * @return bool
     */
    private function isGameOver()
    {
        foreach ($this->rules as $rule) {
            if (!$rule->applyRule($this->gauges)) {
                return false;
            }
        }
        return true;
    }
}
