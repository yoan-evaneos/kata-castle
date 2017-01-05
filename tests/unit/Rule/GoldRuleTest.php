<?php

namespace Kata\Test\Rule;

use Kata\Component\GoldGauge;
use Kata\Rule\GoldRule;
use Mockery;
use Mockery\Mock;

/**
 * Class GoldRuleTest
 *
 * @package Kata\Test\Rule
 **/
class GoldRuleTest extends \PHPUnit_Framework_TestCase
{
    /** @var GoldRule */
    private $serviceUnderTest;

    /** @var  GoldGauge|Mock */
    private $goldGauge;

    /**
     * Init the mocks
     */
    public function setUp()
    {
        $this->goldGauge = Mockery::mock(GoldGauge::class);
        $this->serviceUnderTest = new GoldRule($this->goldGauge);
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
        $result = $this->serviceUnderTest->applyRule([]);
        $this->assertFalse($result);
    }
}
