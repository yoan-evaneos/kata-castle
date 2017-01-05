<?php

namespace Kata\Test\Rule;

use Kata\Component\ArmyGauge;
use Kata\Rule\ArmyRule;
use Mockery;
use Mockery\Mock;

/**
 * Class ArmyRuleTest
 *
 * @package Kata\Test\Rule
 **/
class ArmyRuleTest extends \PHPUnit_Framework_TestCase
{
    /** @var ArmyRule */
    private $serviceUnderTest;

    /** @var  ArmyGauge|Mock */
    private $armyGauge;

    /**
     * Init the mocks
     */
    public function setUp()
    {
        $this->armyGauge = Mockery::mock(ArmyGauge::class);
        $this->serviceUnderTest = new ArmyRule($this->armyGauge);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function it_should_not_be_game_over()
    {
        $this->given_armyGauge_getValue_return_5();
        $result = $this->serviceUnderTest->applyRule([]);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function it_should_be_game_over()
    {
        $this->given_armyGauge_getValue_return_10();

        $result = $this->serviceUnderTest->applyRule([]);
        $this->assertTrue($result);
    }

    private function given_armyGauge_getValue_return_5()
    {
        $this->armyGauge->shouldReceive('getValue')
            ->andReturn(5);
    }

    private function given_armyGauge_getValue_return_10()
    {
        $this->armyGauge->shouldReceive('getValue')
            ->andReturn(10);
    }
}
