<?php

declare(strict_types=1);

namespace Tests\Bench;

use Bugo\FontAwesomeHelper\Enums\Size;

class EnumInArrayBench
{
    private $size = '3x';
    private array $allowedSizes = [
        '2xs', 'xs', 'sm', 'lg', 'xl', '2xl',
        '1x', '2x', '3x', '4x', '5x',
        '6x', '7x', '8x', '9x', '10x',
    ];
    /**
     * @Revs(1500000)
     * @Iterations(10)
     */
    public function benchFullyQualifiedInArrayWithFound()
    {
        if (! \in_array($this->size, $this->allowedSizes)) {
            $size = '1x';
        }
    }

    /**
     * @Revs(1500000)
     * @Iterations(10)
     */
    public function benchFullyQualifiedInArrayWithNotFound()
    {
        if (! \in_array('12x', $this->allowedSizes)) {
            $size = '1x';
        }
    }

    /**
     * @Revs(1500000)
     * @Iterations(10)
     */
    public function benchNonQualifiedInArrayWithFound()
    {
        if (! in_array($this->size, $this->allowedSizes)) {
            $size = '1x';
        }
    }

    /**
     * @Revs(1500000)
     * @Iterations(10)
     */
    public function benchNonQualifiedInArrayWithNotFound()
    {
        if (! in_array('12x', $this->allowedSizes)) {
            $size = '1x';
        }
    }

    /**
     * @Revs(1500000)
     * @Iterations(10)
     */
    public function benchTryFromEnumWithKnownCase()
    {
        $size = Size::tryFrom($this->size) ?? Size::OneX->value;
    }

    /**
     * @Revs(1500000)
     * @Iterations(10)
     */
    public function benchTryFromEnumWithOutKnownCase()
    {
        $size = Size::tryFrom('12x') ?? Size::OneX->value;
    }
}
