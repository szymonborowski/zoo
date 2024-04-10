<?php

declare(strict_types=1);

namespace App\Animal\Api;

use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;

/**
 * Interface for anima repository classes
 *
 * @package App\Animal\Api
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
interface AnimalRepositoryInterface
{
    /**
     * Filter given animal collection by diet type
     *
     * @param AnimalCollectionInterface $animalCollection
     * @param DietOption $diet
     * @return AnimalCollectionInterface
     */
    public function filterByDiet(
        AnimalCollectionInterface $animalCollection,
        DietOption $diet
    ): AnimalCollectionInterface;

    /**
     * Filter given animal collection by animal name
     *
     * @param AnimalCollectionInterface $animalCollection
     * @param Name $name
     * @return AnimalCollectionInterface
     */
    public function filterByName(AnimalCollectionInterface $animalCollection, Name $name): AnimalCollectionInterface;

    /**
     * @param AnimalCollectionInterface $animalCollection
     * @return AnimalCollectionInterface
     */
    public function filterByCanComb(AnimalCollectionInterface $animalCollection): AnimalCollectionInterface;
}