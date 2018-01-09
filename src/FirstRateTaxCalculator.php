<?php

declare(strict_types=1);

namespace KejawenLab\Pajak\PPH21;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@gmail.com>
 */
class FirstRateTaxCalculator extends AbstractTaxCalculator
{
    public function maxPtkp(): float
    {
        return 50000000;
    }

    public function minPtkp(): float
    {
        return 0;
    }

    public function taxPercentage(): float
    {
        return 0.05;
    }
}
