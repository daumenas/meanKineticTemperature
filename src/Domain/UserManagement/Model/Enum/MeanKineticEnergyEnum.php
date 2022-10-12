<?php declare(strict_types=1);

namespace App\Domain\UserManagement\Model\Enum;

use Doctrine\Common\Annotations\Annotation\Enum;
use RuntimeException;

/**
 * @method static MeanKineticEnergyEnum KELVIN()
 * @method static MeanKineticEnergyEnum DELTA_H()
 * @method static MeanKineticEnergyEnum GAS()
 */
class MeanKineticEnergyEnum
{
    const KELVIN = 273.15;
    const DELTA_H = 83.144;
    const GAS = 0.008314472;
}