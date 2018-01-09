<?php

require 'vendor/autoload.php';

use Ihsan\OnlinePajak\TaxCalculator;
use Ihsan\OnlinePajak\FirstRateTaxCalculator;
use Ihsan\OnlinePajak\SecondRateTaxCalculator;
use Ihsan\OnlinePajak\ThirdRateTaxCalculator;
use Ihsan\OnlinePajak\FourthRateTaxCalculator;
use Symfony\Component\Console\Output\ConsoleOutput;

$output = new ConsoleOutput();

$first = new FirstRateTaxCalculator();

$second = new SecondRateTaxCalculator();
$second->setPrevious($first);

$third = new ThirdRateTaxCalculator();
$third->setPrevious($second);

$fourth = new FourthRateTaxCalculator();
$fourth->setPrevious($third);

$chain = new TaxCalculator([$first, $second, $third, $fourth]);
$chain->setOutput($output);

$tax = $chain->calculate(45000000);

var_dump($tax);

$tax = $chain->calculate(75000000);

var_dump($tax);

$tax = $chain->calculate(300000000);

var_dump($tax);

$tax = $chain->calculate(750000000);

var_dump($tax);
