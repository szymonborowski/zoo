<?php

declare(strict_types=1);

namespace App\Zoo\Model\Entity;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Api\AnimalInterface;
use App\Animal\Api\AnimalRepositoryInterface;
use App\Animal\Model\Attributes\DietOption;
use App\Animal\Model\Attributes\Name;
use App\Zoo\Api\ZooInterface;


/**
 * This class allows to perform useful actions on animas in Zoo
 *
 * @package App\Animal\Model\Entity
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @version 1.0.0
 */
class Zoo implements ZooInterface
{
    public function __construct(
        private readonly AnimalCollectionInterface $animals,
        private readonly AnimalRepositoryInterface $animalRepository
    ) {
    }

    /**
     * Perform an action common for all animals in ZOO
     *
     * @return void
     */
    public function feedAllAnimalsInZoo(): void
    {
        foreach ($this->animals as $animal) {
            $animal->eat();
        }
    }

    /**
     * Get list of all animals with special feature (Diet = Carnivore)
     *
     * @return AnimalCollectionInterface
     */
    public function listOfCarnivores(): AnimalCollectionInterface
    {
        return $this->animalRepository->filterByDiet($this->animals, DietOption::Carnivore);
    }

    /**
     * Get list of all animals with special feature (Diet = Herbivores)
     *
     * @return AnimalCollectionInterface
     */
    public function listOfHerbivores(): AnimalCollectionInterface
    {
        return $this->animalRepository->filterByDiet($this->animals, DietOption::Herbivore);
    }

    /**
     * Get list of all animals with special feature (Diet = Omnivores)
     *
     * @return AnimalCollectionInterface
     */
    public function listOfOmnivores(): AnimalCollectionInterface
    {
        return $this->animalRepository->filterByDiet($this->animals, DietOption::Omnivore);
    }

    /**
     * Perform action comb on all animals who have to be combed
     *
     * @return void
     */
    public function combAllAnimals(): void
    {
        $listOfAnimalsWithFur = $this->animalRepository->filterByCanComb($this->getAnimalCollection());

        foreach ($listOfAnimalsWithFur as $animal) {
            $animal->comb();
        }
    }

    /**
     * Find animal by it name
     *
     * @param $name
     * @return AnimalInterface|null
     */
    public function getAnimalByName($name): ?AnimalInterface
    {
        $animals = $this->animalRepository->filterByName($this->getAnimalCollection(), Name::fromString($name));

        return isset($animals[0]) ? $animals[0] : null;
    }

    /**
     * Get all animal collection
     *
     * @return AnimalCollectionInterface
     */
    public function getAnimalCollection(): AnimalCollectionInterface
    {
        return $this->animals;
    }
}