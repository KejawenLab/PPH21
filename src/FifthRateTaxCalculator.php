<?php

declare(strict_types=1);

namespace KejawenLab\Pajak\PPH21;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@gmail.com>
 */
class FifthRateTaxCalculator extends AbstractTaxCalculator
{
    public function maxPtkp(): float
    {
        return 10000000000000;
    }

    public function minPtkp(): float
    {
        return 5000000000;
    }

    public function taxPercentage(): float
    {
        return 0.35;
    }
}
