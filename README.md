# Aplikacja ZOO v1.0.0

Autor: Szymon Borowski szymon.borowski@gmail.com

Copyright &copy; Szymon Borowski All rights reserved.

### Aplikacja została napisana w taki sposób, aby w jak najmniejszym stopniu korzystać z zewnętrznych zależności w postaci bibliotek i framworków. Ponieważ celem zadania było w głównej mierze stworzenie struktury klass dla zwierząt i zoo, warstwa widoku ogranicza się do printowania komunikatów związanych z akcjami na obiektach zwierząt i zoo.

## W celu uruchomienia aplikacji wykonaj polecenia: 
`# composer install`
`# php index.php`

Poniższy kod jest odpowiedzią na zadanie rekrutacyje.
Treść zadania:

Zaprojektuj system klas wirtualnego ZOO, który spełnia następujące wymagania:

• Każde zwierze w ZOO ma swoje imię. Kiedy użyjemy obiektu zwierzęcia jako ciąg znaków,
powinien on zwrócić gatunek oraz jego imię, np:

> $dog = new Dog(/* ... */);```
>
> //...
>
> echo $dog;

Powinno przykładowo wypisać:
Pies Duke

• Zwierzęta powinny móc być umieszczone w ZOO (dla uproszczenia zakładamy, że
zwierzęta nie zjedzą się nawzajem i nie muszą przebywać w różnych boksach).

• Zwierzęta dzielą się na mięsożerne, roślinożerne, wszystkożerne. Dlatego powinny one
przyjmować różne typy posiłków. Zwierzęta mięsożerne powinny przyjmować posiłki
mięsne, zwierzęta roślinożerne posiłki roślinne, a zwierzęta wszystkożerne powinny
przyjmować oba typy posiłków.

• Niektóre zwierzęta posiadają futro, które należy czesać by dobrze się prezentowały. Klasy
zwierząt posiadających futro powinny zawierać metodę pozwalającą na ich czesanie.

• System klas powinien obejmować następujące gatunki: tygrys, słoń, nosorożec, lis, irbis
śnieżny, królik.

Ocenie podlega sposób podejścia do wykonania zadania, przejrzystość oraz czytelność kodu,
możliwość ewentualnej rozbudowy.