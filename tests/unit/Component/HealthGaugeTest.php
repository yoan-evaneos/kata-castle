<?php

namespace Kata\Test\Component;

use Kata\Component\ArmyGauge;
use Kata\Component\HealthGauge;

class HealthGaugeTest extends \PHPUnit_Framework_TestCase
{
    /** @var ArmyGauge */
    private $serviceUnderTest;

    /**
     * Init the mocks
     */
    public function setUp()
    {
        $this->serviceUnderTest = new HealthGauge();
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function it_should_initialize_a_health_gauge()
    {
        $this->assertEquals(HealthGauge::GAUGE_NAME, $this->serviceUnderTest->getType());
        $this->assertEquals(5, $this->serviceUnderTest->getValue());
    }

    /**
     * @test
     */
    public function it_should_increase_gauge_value()
    {
        $this->serviceUnderTest->increase(2);
        $this->assertEquals(7, $this->serviceUnderTest->getValue());
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_increased_value_is_lower_than_current_value() {
        $this->setExpectedException(\InvalidArgumentException::class);
        $this->serviceUnderTest->increase(-2);
    }

    /**
     * @test
     */
    public function it_should_not_increase_with_max_value() {
        $this->serviceUnderTest->increase(11);
        $this->assertEquals(10, $this->serviceUnderTest->getValue());
    }

    /**
     * @test
     */
    public function it_should_decrease_gauge_value()
    {
        $this->serviceUnderTest->decrease(4);
        $this->assertEquals(1, $this->serviceUnderTest->getValue());
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_decreased_value_is_greater_than_current_value() {
        $this->setExpectedException(\InvalidArgumentException::class);
        $this->serviceUnderTest->decrease(-2);
    }

    /**
     * @test
     */
    public function it_should_not_decrease_with_min_value() {
        $this->serviceUnderTest->decrease(11);
        $this->assertEquals(0, $this->serviceUnderTest->getValue());
    }
}
