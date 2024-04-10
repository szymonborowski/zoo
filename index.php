<?php

use App\Animal\Api\AnimalCollectionInterface;
use App\Animal\Api\AnimalRepositoryInterface;
use App\Animal\Factory\AnimalCollectionFactory;
use App\Animal\Factory\AnimalRepositoryFactory;
use App\Animal\Model\Entity\Elephant;
use App\Animal\Model\Entity\Fox;
use App\Animal\Model\Entity\Rabbit;
use App\Animal\Model\Entity\Rhinoceros;
use App\Animal\Model\Entity\SnowLeopard;
use App\Animal\Model\Entity\Tiger;
use App\Zoo\Model\Entity\Zoo;

require_once('./vendor/autoload.php');

$zoo = new Zoo(
    AnimalCollectionFactory::create(AnimalCollectionInterface::class),
    AnimalRepositoryFactory::create(AnimalRepositoryInterface::class)
);

// Creation and population of Zoo
$zoo->getAnimalCollection()
    ->addData(
        [
            Elephant::create('Maksim'),
            Fox::create('Maryś'),
            Rabbit::create('Renia'),
            Rhinoceros::create('Bartek'),
            SnowLeopard::create('Zuzia'),
            Tiger::create('Wojtek'),
//            Tiger::create('Wojtek'), // This action is not allowed
        ]
    );

// Available zoo actions
echo "\n";
echo "Feeding all animals \n";
$zoo->feedAllAnimalsInZoo();
echo "\n";

echo "Combing all animals \n";
$zoo->combAllAnimals();
echo "\n";

echo "Find animal in zoo by name \n";
echo $zoo->getAnimalByName('Bartek');
echo "\n";

echo "\n";
echo "Find List of omnivores \n";
foreach ($zoo->listOfOmnivores() as $animal) {
    echo $animal . "\n";
}
echo "\n";

echo "Find List of herbivores \n";
foreach ($zoo->listOfHerbivores() as $animal) {
    echo $animal . "\n";
}
echo "\n";

echo "Find List of herbivores \n";
foreach ($zoo->listOfCarnivores() as $animal) {
    echo $animal . "\n";
}
echo "\n";

echo "Casting animal object to string \n";
// Presentation of casting animals object on string
$tiger = Tiger::create('Ania');

echo $tiger;
echo "\n";
