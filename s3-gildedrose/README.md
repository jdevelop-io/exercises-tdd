# GildedRose Kata

Tu reprends le code d'une auberge fantastique qui vend des objets dont la qualité change chaque jour. Le code est en place mais c'est un cauchemar à maintenir.

Allison, la propriétaire, vient de signer un contrat avec un nouveau fournisseur d'objets "Conjured" et te demande d'ajouter le support. Avant de toucher au code, tu sécurises l'existant avec des tests de caractérisation, puis tu refactores, et enfin tu ajoutes la nouvelle feature en TDD.

## Les règles métier (à respecter scrupuleusement)

Le système gère un stock d'objets. Chaque objet a un nom, une `sellIn` (jours restants avant la date limite de vente) et une `quality` (qualité actuelle). À la fin de chaque journée, le système met à jour ces deux valeurs via `updateQuality()`.

### Règles communes à tous les objets

- À la fin de chaque journée, `sellIn` diminue de 1
- À la fin de chaque journée, `quality` diminue de 1
- Une fois la date `sellIn` dépassée (négative), `quality` diminue 2 fois plus vite
- `quality` n'est jamais négative
- `quality` ne dépasse jamais 50

### Exceptions par type d'objet

- **"Aged Brie"** : sa qualité augmente avec le temps (au lieu de diminuer)
- **"Sulfuras, Hand of Ragnaros"** : objet légendaire, sa qualité ne change jamais et reste à 80 (donc l'invariant "quality <= 50" ne s'applique pas à lui), sa `sellIn` ne change jamais
- **"Backstage passes to a TAFKAL80ETC concert"** :
  - Sa qualité augmente avec le temps
  - Augmente de 2 quand il reste 10 jours ou moins
  - Augmente de 3 quand il reste 5 jours ou moins
  - Tombe à 0 après le concert (sellIn négative)

### Nouvelle feature à ajouter

- **"Conjured"** : ces objets perdent en qualité 2 fois plus vite que les objets normaux

## Contraintes

- **Tu n'as PAS le droit de modifier `Item.php`** (la classe Item est utilisée par un système Goblin externe que tu ne contrôles pas, ils te tueront si tu changes la signature)
- Tu peux créer toutes les nouvelles classes que tu veux
- Tu peux refactorer `GildedRose.php` librement, à condition que `updateQuality()` continue à respecter le contrat ci-dessus

## Démarche

1. **Caractérisation tests** : avant de refactorer, écris des tests qui capturent le comportement actuel pour tous les types d'objet (Standard, AgedBrie, Sulfuras, Backstage). Utilise `Program.php` pour t'inspirer des cas à couvrir.
2. **Refactor** : maintenant que le code est sous filet, refactore vers une structure maintenable (Strategy pattern recommandé : 1 stratégie par type d'objet).
3. **Ajout Conjured en TDD** : écris le test, fais-le passer, refactor.

## Lancer les tests

    ./vendor/bin/phpunit --testsuite s3-gildedrose

## Lancer la démo (visualiser le comportement actuel)

    php s3-gildedrose/src/Program.php

Cette commande simule 30 jours et affiche l'état du stock chaque jour. Idéal pour comprendre le comportement avant refactoring.

Bonne chance.
