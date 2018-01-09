<?php

declare(strict_types=1);

namespace KejawenLab\Pajak\PPH21;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@gmail.com>
 */
class SecondRateTaxCalculator extends AbstractTaxCalculator
{
    public function maxPtkp(): float
    {
        return 250000000;
    }

    public function minPtkp(): float
    {
        return 50000000;
    }

    public function taxPercentage(): float
    {
        return 0.15;
    }
}
