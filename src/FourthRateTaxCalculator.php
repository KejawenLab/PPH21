<?php

declare(strict_types=1);

namespace KejawenLab\Pajak\PPH21;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@gmail.com>
 */
class FourthRateTaxCalculator extends AbstractTaxCalculator
{
    public function maxPtkp(): float
    {
        return 10000000000000;
    }

    public function minPtkp(): float
    {
        return 500000000;
    }

    public function taxPercentage(): float
    {
        return 0.3;
    }
}
