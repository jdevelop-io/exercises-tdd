# exercises-tdd

[![CI](https://github.com/jdevelop-io/exercises-tdd/actions/workflows/ci.yml/badge.svg)](https://github.com/jdevelop-io/exercises-tdd/actions/workflows/ci.yml)

Starter code pour les ateliers de la formation **JDevelop : TDD, concevoir par les tests**.

## À quoi ça sert

Ce repo contient le code de départ des 3 ateliers pratiques de la formation TDD. Tu le clones au début de chaque session et tu codes en TDD strict dans ton IDE.

Chaque atelier démarre avec un placeholder qui sera remplacé par tes propres tests et ton code, en suivant la discipline Red, Green, Refactor.

## Prérequis

- PHP 8.2 ou supérieur
- [Composer 2](https://getcomposer.org/)
- Un IDE PHP (PHPStorm, VSCode avec PHP Intelephense, ou équivalent)
- Avoir suivi la formation **JDevelop : Les fondamentaux des tests automatisés** (ou maitriser PHPUnit, AAA et la dependency injection)

Vérifie ta version de PHP :

    php --version

Si tu es en dessous de 8.2, mets à jour avant la formation.

## Installation

    git clone https://github.com/jdevelop-io/exercises-tdd.git
    cd exercises-tdd
    composer install

Vérifie que PHPUnit est bien installé :

    ./vendor/bin/phpunit --version

Tu dois voir quelque chose comme `PHPUnit 10.5.x`.

## Les 3 ateliers

### Session 1 : atelier `s1-fizzbuzz`

Objectif : maitriser la discipline du cycle Red, Green, Refactor sur un kata simple. 1 test = 1 comportement, refactor visible à chaque étape, pas de code spéculatif.

Tu crées la classe FizzBuzz dans `s1-fizzbuzz/src/FizzBuzz.php` et tu écris tes tests dans `s1-fizzbuzz/tests/FizzBuzzTest.php`.

Lancer les tests :

    ./vendor/bin/phpunit --testsuite s1-fizzbuzz

### Session 2 : atelier `s2-bank-account`

Objectif : implémenter une feature complète (compte bancaire avec transferts) en TDD strict, en suivant l'architecture hexagonale (ports et adapters). Le domaine ne connait pas la persistance, le use case orchestre via une interface.

Le squelette fourni :
- `s2-bank-account/src/Account.php` : entité de domaine (à étoffer)
- `s2-bank-account/src/AccountRepository.php` : port (interface)

Tu crées les use cases, l'implémentation in-memory du repository, et les tests.

Lancer les tests :

    ./vendor/bin/phpunit --testsuite s2-bank-account

### Session 3 : atelier `s3-gildedrose`

Objectif : reprendre du code legacy (le célèbre kata GildedRose d'Emily Bache, adapté), le sécuriser par des tests de caractérisation, le refactorer, puis ajouter une nouvelle feature en TDD.

Lis attentivement les règles dans `s3-gildedrose/README.md` avant de commencer. Le fichier `Program.php` te permet de visualiser le comportement actuel.

**Contrainte du kata** : tu ne peux pas modifier `Item.php` (la classe est utilisée par un système Goblin externe).

Lancer la démo (30 jours par défaut, ou N jours en argument) :

    php s3-gildedrose/src/Program.php
    php s3-gildedrose/src/Program.php 7

Lancer les tests :

    ./vendor/bin/phpunit --testsuite s3-gildedrose

## Lancer tous les tests

    ./vendor/bin/phpunit

## Solutions de référence

Les solutions complètes vivent sur des branches dédiées :

- `solutions/s1` : FizzBuzz résolu en 8 tests
- `solutions/s2` : BankAccount avec hexagonal complet (Money VO, TransferUseCase, InMemoryAccountRepository)
- `solutions/s3` : GildedRose refactoré avec Strategy pattern, tests de caractérisation, support Conjured items

Pour consulter une solution :

    git fetch origin
    git checkout solutions/s1
    ./vendor/bin/phpunit --testsuite s1-fizzbuzz

Reviens sur `main` :

    git checkout main

**Joue le jeu** : essaie d'écrire la solution toi-même avant de regarder la branche. Le TDD ne s'apprend qu'en pratiquant.

## Licence

MIT. Voir [LICENSE](./LICENSE).

Ce repo fait partie de la formation **JDevelop : TDD, concevoir par les tests**. Plus d'infos sur [jdevelop.io](https://jdevelop.io).
