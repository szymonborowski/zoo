<?php

declare(strict_types=1);

namespace App\Animal\Api;

use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;

/**
 * Interface for anima classes
 *
 * @package App\Animal\Api
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
interface AnimalInterface
{
    /**
     * Return animal name object
     *
     * @return Name
     */
    public function name(): Name;

    /**
     * Return animal diet option
     *
     * @return DietOption
     */
    public function diet(): DietOption;

    /**
     * Behavior: eat. Common behavior for all animals
     *
     * @return void
     */
    public function eat(): void;
}