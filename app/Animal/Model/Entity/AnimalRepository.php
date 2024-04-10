<?php

declare(strict_types=1);

namespace App\Animal\Model\Entity;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Api\AnimalRepositoryInterface;
use App\Animal\Factory\AnimalCollectionFactory;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;
use App\Animal\Model\Behavior\CanCombTrait;

/**
 * This is a repository class for animas collection. It provides filtering functionality.
 *
 * @package App\Animal\Model\Entity
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class AnimalRepository implements AnimalRepositoryInterface
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
    ): AnimalCollectionInterface {
        $result = AnimalCollectionFactory::create(AnimalCollectionInterface::class);

        foreach ($animalCollection as $animal) {
            if ($animal->diet() === $diet) {
                $result[] = $animal;
            }
        }

        return $result;
    }

    /**
     * Filter given animal collection by animal name
     *
     * @param AnimalCollectionInterface $animalCollection
     * @param Name $name
     * @return AnimalCollectionInterface
     */
    public function filterByName(AnimalCollectionInterface $animalCollection, Name $name): AnimalCollectionInterface
    {
        $result = AnimalCollectionFactory::create(AnimalCollectionInterface::class);

        foreach ($animalCollection as $animal) {
            if ((string)$animal->name()->equals($name)) {
                $result[] = $animal;
            }
        }

        return $result;
    }

    /**
     * @param AnimalCollectionInterface $animalCollection
     * @return AnimalCollectionInterface
     */
    public function filterByCanComb(AnimalCollectionInterface $animalCollection): AnimalCollectionInterface
    {
        $result = AnimalCollectionFactory::create(AnimalCollectionInterface::class);

        foreach ($animalCollection as $key => $animal) {
            if (in_array(CanCombTrait::class, class_uses(get_class($animal)))) {
                $result[] = $animal;
            }
        }

        return $result;
    }
}