<?php

declare(strict_types=1);

namespace App\Animal\Model\Attributes;

/**
 * This enum provide interface for interaction with animals gender options.
 * Using this type of enum prevent from creating animal with invalid attributes.
 *
 * @package App\Animal\Entity\Attribute
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
enum Gender
{
    case Female;
    case Male;
}