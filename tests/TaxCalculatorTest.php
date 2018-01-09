<?php

declare(strict_types=1);

namespace Ihsan\OnlinePajak\Test;

use Ihsan\OnlinePajak\FirstRateTaxCalculator;
use Ihsan\OnlinePajak\FourthRateTaxCalculator;
use Ihsan\OnlinePajak\SecondRateTaxCalculator;
use Ihsan\OnlinePajak\TaxCalculator;
use Ihsan\OnlinePajak\ThirdRateTaxCalculator;
use PHPUnit\Framework\TestCase;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@gmail.com>
 */
class TaxCalculatorTest extends TestCase
{
    /**
     * @var TaxCalculator
     */
    private $calculator;

    public function setUp()
    {
        $first = new FirstRateTaxCalculator();

        $second = new SecondRateTaxCalculator();
        $second->setPrevious($first);

        $third = new ThirdRateTaxCalculator();
        $third->setPrevious($second);

        $fourth = new FourthRateTaxCalculator();
        $fourth->setPrevious($third);

        $this->calculator = new TaxCalculator([$first, $second, $third, $fourth]);
    }

    public function testFirstRateCalculator(): void
    {
        //0.05 * 25.000.000 = 1.250.000
        $this->assertEquals(1250000, $this->calculator->calculate(25000000));
        //0.05 * 30.000.000 = 1.500.000
        $this->assertEquals(1500000, $this->calculator->calculate(30000000));
        //0.05 * 45.000.000 = 2.250.000
        $this->assertEquals(2250000, $this->calculator->calculate(45000000));
        //0.05 * 50.000.000 = 2.500.000
        $this->assertEquals(2500000, $this->calculator->calculate(50000000));
    }

    public function testSecondRateCalculator(): void
    {
        //0.05 * 50.000.000 = 2.500.000php index.php
        //0.15 * 0 = 0
        $this->assertEquals(2500000, $this->calculator->calculate(50000000));
        //0.05 * 50.000.000 = 2.500.000
        //0.15 * 10.000.000 = 1.500.000
        $this->assertEquals(4000000, $this->calculator->calculate(60000000));
        //0.05 * 50.000.000 = 2.500.000
        //0.15 * 25.000.000 = 3.750.000
        $this->assertEquals(6250000, $this->calculator->calculate(75000000));
    }

    public function testThirdRateCalculator(): void
    {
        //0.05 * 50.000.000 = 2.500.000
        //0.15 * 200.000.000 = 30.000.000
        //0.25 * 0 = 0
        $this->assertEquals(32500000, $this->calculator->calculate(250000000));
        //0.05 * 50.000.000 = 2.500.000
        //0.15 * 200.000.000 = 30.000.000
        //0.25 * 50.000.000 = 12.500.000
        $this->assertEquals(45000000, $this->calculator->calculate(300000000));
        //0.05 * 50.000.000 = 2.500.000
        //0.15 * 200.000.000 = 30.000.000
        //0.25 * 200.000.000 = 50.000.000
        $this->assertEquals(82500000, $this->calculator->calculate(450000000));
    }

    public function testFourthRateCalculator(): void
    {
        //0.05 * 50.000.000 = 2.500.000
        //0.15 * 200.000.000 = 30.000.000
        //0.25 * 250.000.000 = 62.500.000
        //0.30 * 250.000.000 = 75.000.000
        $this->assertEquals(170000000, $this->calculator->calculate(750000000));
    }
}
