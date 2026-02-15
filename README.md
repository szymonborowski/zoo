# Zoo Management System

A virtual ZOO class system written in PHP 8.5. The application models animals with different diets (carnivore, herbivore, omnivore) and behaviors (eating, fur combing), placed in a zoo with filtering and search capabilities.

## Architecture

The project follows a Domain-Driven Design approach with two domains:

- **Animal** — animal entities, value objects (Name, DietOption, Gender), behaviors (Strategy Pattern via `CanEatTrait`/`CanCombTrait` traits), repository with filtering, factories
- **Zoo** — orchestration of operations on the animal collection (feeding, combing, searching)

Each domain has an `Api/` layer (interfaces) and a `Model/` layer (implementation), ensuring loose coupling between components.

Species: Tiger, Elephant, Rhinoceros, Fox, SnowLeopard, Rabbit.

## Getting Started (Docker)

```bash
docker compose build
docker compose run zoo-app
```

## Getting Started (local)

Requires PHP ^8.5 with the zip extension.

```bash
composer install
php index.php
```

## Tests

```bash
# Docker
docker compose run zoo-app php vendor/bin/phpunit

# Local
php vendor/bin/phpunit
```
