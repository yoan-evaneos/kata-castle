<?php

namespace Kata\Test\Rule;

use Kata\Component\Gauge;
use Kata\Component\HealthGauge;
use Kata\Component\PeopleGauge;
use Kata\Rule\GoldRule;
use Kata\Rule\HealthRule;
use Mockery;
use Mockery\Mock;

/**
 * Class HealthRuleTest
 *
 * @package Kata\Test\Rule
 **/
class HealthRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Gauge[]
     */
    private $gauges;

    /**
     * @var HealthRule
     * */
    private $serviceUnderTest;

    /** @var HealthGauge|Mock */
    private $healthGauge;

    /**
     * @var PeopleGauge|Mock
     */
    private $peopleGauge;

    /**
     * Init the mocks
     */
    public function setUp()
    {
        $this->healthGauge = Mockery::mock(HealthGauge::class);
        $this->peopleGauge = Mockery::mock(PeopleGauge::class);

        $this->gauges = [
            PeopleGauge::GAUGE_NAME => $this->peopleGauge
        ];

        $this->serviceUnderTest = new HealthRule($this->healthGauge);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function it_should_decrease_people_for_critical_health_and_be_game_over()
    {
        $this->given_health_gauge_has_a_critical_value();
        $this->then_people_should_decrease_the_value_by_2();
        $result = $this->serviceUnderTest->applyRule($this->gauges);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_decrease_people_for_urgent_health()
    {
        $this->given_health_gauge_has_a_urgent_value();
        $this->then_people_should_decrease_the_value_by_1();
        $result = $this->serviceUnderTest->applyRule($this->gauges);
        $this->assertFalse($result);
    }

    public function it_should_increase_people_for_excellent_health()
    {
        $this->given_health_gauge_has_an_excellent_value();
        $this->then_people_should_increase_the_value_by_1();
        $result = $this->serviceUnderTest->applyRule($this->gauges);
        $this->assertFalse($result);
    }

    private function given_health_gauge_has_a_critical_value()
    {
        $this->healthGauge->shouldReceive('getValue')
            ->andReturn(1);
    }

    private function then_people_should_decrease_the_value_by_2()
    {
        $this->peopleGauge->shouldReceive('decrease')
            ->with(2);
    }

    private function given_health_gauge_has_a_urgent_value()
    {
        $this->healthGauge->shouldReceive('getValue')
            ->andReturn(3);
    }

    private function then_people_should_decrease_the_value_by_1()
    {
        $this->peopleGauge->shouldReceive('decrease')
            ->with(1);
    }

    private function given_health_gauge_has_an_excellent_value()
    {
        $this->healthGauge->shouldReceive('getValue')
            ->andReturn(9);
    }

    private function then_people_should_increase_the_value_by_1()
    {
        $this->peopleGauge->shouldReceive('increase')
            ->with(1);
    }
}
