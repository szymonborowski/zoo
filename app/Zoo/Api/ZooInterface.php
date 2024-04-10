<?php

declare(strict_types=1);

namespace App\Zoo\Api;

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Api\AnimalInterface;
use App\Animal\Model\Attributes\Name;

interface ZooInterface
{
    /**
     * Perform an action common for all animals in ZOO
     *
     * @return void
     */
    public function feedAllAnimalsInZoo(): void;

    /**
     * Get list of all animals with special feature (Diet = Carnivore)
     *
     * @return AnimalCollectionInterface
     */
    public function listOfCarnivores(): AnimalCollectionInterface;

    /**
     * Get list of all animals with special feature (Diet = Herbivores)
     *
     * @return AnimalCollectionInterface
     */
    public function listOfHerbivores(): AnimalCollectionInterface;

    /**
     * Get list of all animals with special feature (Diet = Omnivores)
     *
     * @return AnimalCollectionInterface
     */
    public function listOfOmnivores(): AnimalCollectionInterface;


    /**
     * Perform action comb on all animals who have to be combed
     *
     * @return void
     */
    public function combAllAnimals(): void;

    /**
     * Find animal by it name
     *
     * @param $name
     * @return AnimalInterface|null
     */
    public function getAnimalByName($name): ?AnimalInterface;

    /**
     * Get all animal collection
     *
     * @return AnimalCollectionInterface
     */
    public function getAnimalCollection(): AnimalCollectionInterface;
}