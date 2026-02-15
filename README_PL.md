# Zoo Management System

System klas wirtualnego ZOO napisany w PHP 8.5. Aplikacja modeluje zwierzęta z różnymi dietami (mięsożerne, roślinożerne, wszystkożerne) oraz zachowaniami (jedzenie, czesanie futra), umieszczone w zoo z możliwością filtrowania i wyszukiwania.

## Architektura

Projekt stosuje podejście Domain-Driven Design z podziałem na dwie domeny:

- **Animal** — encje zwierząt, value objects (Name, DietOption, Gender), zachowania (Strategy Pattern przez traity `CanEatTrait`/`CanCombTrait`), repozytorium z filtrowaniem, fabryki
- **Zoo** — orkiestracja operacji na kolekcji zwierząt (karmienie, czesanie, wyszukiwanie)

Każda domena posiada warstwę `Api/` (interfejsy) i `Model/` (implementacja), co zapewnia luźne powiązanie komponentów.

Gatunki: Tiger, Elephant, Rhinoceros, Fox, SnowLeopard, Rabbit.

## Uruchomienie (Docker)

```bash
docker compose build
docker compose run zoo-app
```

## Uruchomienie (lokalne)

Wymagane PHP ^8.5 z rozszerzeniem zip.

```bash
composer install
php index.php
```

## Testy

```bash
# Docker
docker compose run zoo-app php vendor/bin/phpunit

# Lokalnie
php vendor/bin/phpunit
```
