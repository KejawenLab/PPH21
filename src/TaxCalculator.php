<?php

declare(strict_types=1);

namespace Ihsan\OnlinePajak;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@gmail.com>
 */
class TaxCalculator
{
    /**
     * @var TaxCalculatorInterface[]
     */
    private $calculators;

    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(array $taxCalculators = [])
    {
        foreach ($taxCalculators as $taxCalculator) {
            $this->addCalculator($taxCalculator);
        }
    }

    /**
     * @param OutputInterface $output
     */
    public function setOutput($output): void
    {
        $this->output = $output;
    }

    public function calculate(float $ptkp): float
    {
        foreach ($this->calculators as $calculator) {
            if ($calculator->isSupportPtkp($ptkp)) {
                if ($this->output) {
                    $this->output->writeln(sprintf('<info>Calculator triggered: %s => %s</info>', get_class($calculator), $ptkp));
                }

                return $calculator->calculate($ptkp);
            }
        }

        throw new InvalidCalculatorException();
    }

    private function addCalculator(TaxCalculatorInterface $taxCalculator)
    {
        $this->calculators[] = $taxCalculator;
    }
}
