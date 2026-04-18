# Plan C TDD : Repo `exercises-tdd` Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build a public GitHub repo `jdevelop-io/exercises-tdd` containing PHP 8.2 + PHPUnit 10 starter code for the 3 ateliers of the JDevelop "TDD : concevoir par les tests" formation (FizzBuzz, Bank Account, GildedRose), with `solutions/s1`, `solutions/s2`, `solutions/s3` branches holding the reference solutions.

**Architecture:** Single Composer project with PSR-4 autoload split across 3 atelier folders (`s1-fizzbuzz/`, `s2-bank-account/`, `s3-gildedrose/`). Each atelier has its own `src/` and `tests/`. `main` holds the starter code; 3 `solutions/*` branches hold the correct reference implementations following Detroit-school TDD (Account use cases with hexagonal ports, GildedRose refactored with strategy pattern). MIT license, public repo. CI runs `composer validate`, `php -l`, and `phpunit` only on `solutions/*` branches.

**Tech Stack:** PHP 8.2+ (system has 8.5), Composer 2, PHPUnit 10.5+, GitHub Actions, gh CLI, MIT license.

**Spec reference:** `~/Development/Projects/jdevelop-formations/.claude/superpowers/specs/2026-04-18-tdd-formation-design.md` (sections 2, 3 partial, 8 partial, 9 partial cover the exercises repo)

**Working directory:** `~/Development/Contributions/exercises-tdd/`

**Style constraints:**
- No em-dashes (`—`) or en-dashes (`–`) in any prose, comment, frontmatter, or commit message. Use `:`, `,`, `.`, `(...)` instead. The PHP arrow operator `->` is allowed.
- Commit format : gitmoji + conventional commit. No `Co-Authored-By: Claude` or AI mentions.
- French for user-facing content (README, comments). English for technical identifiers.
- Never hand-edit composer.json's `require`/`require-dev`. Use `composer require`, `composer remove`. Editing other fields (`autoload`, `name`, `scripts`) is fine.
- All PHP files : `declare(strict_types=1)`, namespace under `JDevelop\Exercises\Tdd\*`, classes are `final` (except where extension is needed by the kata).

---

## File structure after this plan

### On `main` branch

```
exercises-tdd/
├── .claude/superpowers/plans/2026-04-18-plan-c-exercises-tdd.md  [EXISTS, this file]
├── .github/
│   └── workflows/ci.yml
├── .gitignore
├── LICENSE
├── README.md
├── composer.json
├── phpunit.xml
├── s1-fizzbuzz/
│   ├── src/
│   └── tests/
│       └── FizzBuzzTest.php
├── s2-bank-account/
│   ├── src/
│   │   ├── Account.php
│   │   └── AccountRepository.php
│   └── tests/
│       └── AccountTest.php
└── s3-gildedrose/
    ├── README.md
    ├── src/
    │   ├── GildedRose.php
    │   ├── Item.php
    │   └── Program.php
    └── tests/
        └── GildedRoseTest.php
```

### On `solutions/s1` branch

- Modified : `s1-fizzbuzz/src/FizzBuzz.php` (created)
- Modified : `s1-fizzbuzz/tests/FizzBuzzTest.php` (8 tests)

### On `solutions/s2` branch

- Modified : `s2-bank-account/src/Account.php` (full impl)
- Modified : `s2-bank-account/src/AccountRepository.php` (interface)
- Created : `s2-bank-account/src/Money.php`
- Created : `s2-bank-account/src/InMemoryAccountRepository.php`
- Created : `s2-bank-account/src/TransferUseCase.php`
- Created : `s2-bank-account/src/InsufficientFundsException.php`
- Modified : `s2-bank-account/tests/AccountTest.php` (10 tests covering Account + Transfer)

### On `solutions/s3` branch

- Modified : `s3-gildedrose/src/GildedRose.php` (refactored)
- Created : `s3-gildedrose/src/UpdateStrategy.php` (interface)
- Created : `s3-gildedrose/src/StandardItemStrategy.php`
- Created : `s3-gildedrose/src/AgedBrieStrategy.php`
- Created : `s3-gildedrose/src/SulfurasStrategy.php`
- Created : `s3-gildedrose/src/BackstagePassStrategy.php`
- Created : `s3-gildedrose/src/ConjuredItemStrategy.php`
- Created : `s3-gildedrose/src/StrategyFactory.php`
- Modified : `s3-gildedrose/tests/GildedRoseTest.php` (caractérisation tests + Conjured items)

---

## Phase 1 : Repo bootstrap

### Task 1 : Initialize the repository with LICENSE, .gitignore, README stub

**Files:**
- Create: `LICENSE`
- Create: `.gitignore`
- Create: `README.md` (stub)

The working directory `~/Development/Contributions/exercises-tdd/` already exists with the `.claude/` folder containing this plan. No git history yet.

- [ ] **Step 1 : Verify working directory and plan presence**

```bash
cd ~/Development/Contributions/exercises-tdd
ls -la .claude/superpowers/plans/
```

Expected : the file `2026-04-18-plan-c-exercises-tdd.md` is listed.

- [ ] **Step 2 : Initialize git with `main` as default branch**

```bash
git init -b main
```

Expected : `Initialized empty Git repository`.

- [ ] **Step 3 : Create `LICENSE` (MIT)**

```
MIT License

Copyright (c) 2026 Jean-Denis VIDOT / JDevelop

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

- [ ] **Step 4 : Create `.gitignore`**

```
/vendor/
/.phpunit.cache/
/.phpunit.result.cache
composer.lock
.idea/
.vscode/
.DS_Store
*.log
```

- [ ] **Step 5 : Create `README.md` stub**

```markdown
# exercises-tdd

Starter code pour les ateliers de la formation JDevelop : « TDD, concevoir par les tests ».

Documentation complète à venir.
```

- [ ] **Step 6 : Stage and commit**

```bash
git add LICENSE .gitignore README.md .claude/superpowers/plans/2026-04-18-plan-c-exercises-tdd.md
git commit -m ":tada: chore: initialize exercises-tdd repo"
```

- [ ] **Step 7 : Verify**

```bash
git log --oneline
git status
```

Expected : 1 commit, clean tree, 4 files in commit.

---

### Task 2 : Bootstrap Composer and PHPUnit

**Files:**
- Create: `composer.json` (via composer init)
- Modify: `composer.json` (add autoload PSR-4 blocks via composer config)
- Create: `phpunit.xml`

- [ ] **Step 1 : Run composer init**

```bash
cd ~/Development/Contributions/exercises-tdd
composer init --no-interaction \
  --name="jdevelop-io/exercises-tdd" \
  --description="Starter code pour les ateliers de la formation JDevelop : TDD, concevoir par les tests." \
  --type=project \
  --license=MIT \
  --require-dev="phpunit/phpunit:^10.5"
```

Expected : creates `composer.json`, downloads `phpunit/phpunit ^10.5`, creates `vendor/` and `composer.lock` (gitignored).

- [ ] **Step 2 : Add the `php` platform requirement**

```bash
composer config platform.php 8.2.0
composer config require.php "^8.2"
```

If `composer config require.php` fails (Composer treats `php` as special), use `jq` as fallback :

```bash
jq '.require.php = "^8.2"' composer.json > composer.json.tmp && mv composer.json.tmp composer.json
```

- [ ] **Step 3 : Add PSR-4 autoload entries (3 ateliers)**

```bash
composer config autoload.psr-4.JDevelop\\\\Exercises\\\\Tdd\\\\S1Fizzbuzz\\\\ s1-fizzbuzz/src/
composer config autoload.psr-4.JDevelop\\\\Exercises\\\\Tdd\\\\S2BankAccount\\\\ s2-bank-account/src/
composer config autoload.psr-4.JDevelop\\\\Exercises\\\\Tdd\\\\S3Gildedrose\\\\ s3-gildedrose/src/
```

If `composer config` fails on namespaces with backslashes, use `jq` :

```bash
jq '.autoload."psr-4" = {
  "JDevelop\\Exercises\\Tdd\\S1Fizzbuzz\\": "s1-fizzbuzz/src/",
  "JDevelop\\Exercises\\Tdd\\S2BankAccount\\": "s2-bank-account/src/",
  "JDevelop\\Exercises\\Tdd\\S3Gildedrose\\": "s3-gildedrose/src/"
}' composer.json > composer.json.tmp && mv composer.json.tmp composer.json
```

- [ ] **Step 4 : Add autoload-dev entries**

```bash
composer config autoload-dev.psr-4.JDevelop\\\\Exercises\\\\Tdd\\\\S1Fizzbuzz\\\\Tests\\\\ s1-fizzbuzz/tests/
composer config autoload-dev.psr-4.JDevelop\\\\Exercises\\\\Tdd\\\\S2BankAccount\\\\Tests\\\\ s2-bank-account/tests/
composer config autoload-dev.psr-4.JDevelop\\\\Exercises\\\\Tdd\\\\S3Gildedrose\\\\Tests\\\\ s3-gildedrose/tests/
```

Same fallback with `jq` if needed.

- [ ] **Step 5 : Regenerate the autoloader**

```bash
composer dump-autoload
```

- [ ] **Step 6 : Create `phpunit.xml`**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
         cacheDirectory=".phpunit.cache"
         failOnRisky="false"
         failOnWarning="false">
    <testsuites>
        <testsuite name="s1-fizzbuzz">
            <directory>s1-fizzbuzz/tests</directory>
        </testsuite>
        <testsuite name="s2-bank-account">
            <directory>s2-bank-account/tests</directory>
        </testsuite>
        <testsuite name="s3-gildedrose">
            <directory>s3-gildedrose/tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

- [ ] **Step 7 : Verify suites are recognized**

```bash
./vendor/bin/phpunit --list-suites
```

Expected : 3 suites listed.

- [ ] **Step 8 : Commit**

```bash
git add composer.json phpunit.xml
git commit -m ":wrench: chore: add composer.json and phpunit.xml"
```

---

## Phase 2 : Atelier starters

### Task 3 : Atelier 1 (s1-fizzbuzz) starter

**Files:**
- Create : `s1-fizzbuzz/tests/FizzBuzzTest.php`

The starter for FizzBuzz is intentionally minimal: empty `src/` (the stagiaire creates the FizzBuzz class), and a tests/ file with a placeholder test guide.

- [ ] **Step 1 : Create directory structure**

```bash
mkdir -p s1-fizzbuzz/src s1-fizzbuzz/tests
```

- [ ] **Step 2 : Create `s1-fizzbuzz/tests/FizzBuzzTest.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S1Fizzbuzz\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Atelier 1 : implémente FizzBuzz en TDD strict.
 *
 * Règles :
 *   1. Affiche les nombres de 1 à 100, un par ligne (ou retourne un tableau).
 *   2. Pour les multiples de 3, affiche "Fizz" à la place du nombre.
 *   3. Pour les multiples de 5, affiche "Buzz" à la place du nombre.
 *   4. Pour les multiples de 3 et 5 (donc 15), affiche "FizzBuzz".
 *
 * Discipline TDD :
 *   - 1 test = 1 comportement
 *   - Refactor visible à chaque étape (vert avant refactor)
 *   - Pas de code spéculatif (n'écris que ce qui fait passer le test courant)
 *   - Cycle Red, Green, Refactor : 30 secondes à 5 minutes max
 *
 * Bonus : ajoute "Bang" pour les multiples de 7. Combine avec Fizz et Buzz.
 *
 * Tu crées la classe FizzBuzz dans `s1-fizzbuzz/src/FizzBuzz.php` et tu écris
 * les tests dans cette classe (remplace le placeholder ci-dessous).
 */
final class FizzBuzzTest extends TestCase
{
    #[Test]
    public function placeholder_a_remplacer_par_ton_premier_test(): void
    {
        $this->markTestSkipped('Atelier 1 : démarre par le test "1 retourne 1".');
    }
}
```

- [ ] **Step 3 : Regenerate autoloader**

```bash
composer dump-autoload
```

- [ ] **Step 4 : Verify the suite runs (skipped placeholder)**

```bash
./vendor/bin/phpunit --testsuite s1-fizzbuzz
```

Expected : `OK, but some tests were skipped!`. 1 skipped. Exit code 0.

- [ ] **Step 5 : Commit**

```bash
git add s1-fizzbuzz/
git commit -m ":sparkles: feat(s1): add FizzBuzz starter (empty src, test placeholder)"
```

---

### Task 4 : Atelier 2 (s2-bank-account) starter

**Files:**
- Create: `s2-bank-account/src/Account.php`
- Create: `s2-bank-account/src/AccountRepository.php`
- Create: `s2-bank-account/tests/AccountTest.php`

The starter provides a minimal Account skeleton and an AccountRepository interface. The stagiaire will fill the Account methods, write the AccountRepository in-memory implementation, and add use cases.

- [ ] **Step 1 : Create directory structure**

```bash
mkdir -p s2-bank-account/src s2-bank-account/tests
```

- [ ] **Step 2 : Create `s2-bank-account/src/Account.php` (skeleton)**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

/**
 * Atelier 2 : Account squelette à étoffer.
 *
 * À implémenter en TDD :
 *   - deposit(int $amount) : ajoute au solde, lève une exception si négatif
 *   - withdraw(int $amount) : retire du solde, lève une exception si négatif ou solde insuffisant
 *   - balance() : retourne le solde actuel
 *
 * Pas de Money value object au démarrage (utilise int en centimes pour simplifier).
 * Tu peux extraire un Money plus tard si tu veux explorer les value objects.
 */
final class Account
{
    public function __construct(
        public readonly string $id,
        private int $balance = 0,
    ) {
    }

    public function balance(): int
    {
        return $this->balance;
    }

    // À implémenter :
    // public function deposit(int $amount): void { ... }
    // public function withdraw(int $amount): void { ... }
}
```

- [ ] **Step 3 : Create `s2-bank-account/src/AccountRepository.php` (interface)**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

/**
 * Port (interface) pour persister les Accounts.
 *
 * Implémente une version en mémoire (InMemoryAccountRepository) pour les tests.
 * Une implémentation Postgres ou DynamoDB serait un adapter de production.
 */
interface AccountRepository
{
    public function save(Account $account): void;

    public function findById(string $id): ?Account;
}
```

- [ ] **Step 4 : Create `s2-bank-account/tests/AccountTest.php` (placeholder)**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Atelier 2 : Bank Account avec architecture hexagonale.
 *
 * Étapes suggérées en TDD :
 *
 *   1. Account.deposit() : commencer par "deposit(100) sur solde 0 donne 100"
 *   2. Account.withdraw() : "withdraw(50) sur solde 100 donne 50"
 *   3. Cas limite withdraw : "withdraw plus que le solde lève InsufficientFundsException"
 *   4. AccountRepository : implémenter InMemoryAccountRepository, tester save / findById
 *   5. TransferUseCase : créer le use case qui transfère entre 2 comptes en utilisant le repo
 *
 * Discipline hexagonale :
 *   - Le domaine (Account, Money si tu en crées un) ne connait pas le repo
 *   - Le use case orchestre via les ports (AccountRepository en interface)
 *   - Les tests utilisent l'InMemoryAccountRepository comme fake
 *   - Pas de mocks (école Detroit), uniquement des fakes en mémoire
 *
 * Crée tes fichiers dans `s2-bank-account/src/` selon les besoins.
 */
final class AccountTest extends TestCase
{
    #[Test]
    public function placeholder_a_remplacer_par_ton_premier_test(): void
    {
        $this->markTestSkipped('Atelier 2 : démarre par "deposit ajoute le montant au solde".');
    }
}
```

- [ ] **Step 5 : Regenerate autoloader and verify**

```bash
composer dump-autoload
./vendor/bin/phpunit --testsuite s2-bank-account
```

Expected : `OK, but some tests were skipped!`. 1 skipped.

- [ ] **Step 6 : Commit**

```bash
git add s2-bank-account/
git commit -m ":sparkles: feat(s2): add BankAccount starter (Account skeleton + AccountRepository port)"
```

---

### Task 5 : Atelier 3 (s3-gildedrose) starter

**Files:**
- Create: `s3-gildedrose/README.md` (kata rules)
- Create: `s3-gildedrose/src/Item.php`
- Create: `s3-gildedrose/src/GildedRose.php`
- Create: `s3-gildedrose/src/Program.php`
- Create: `s3-gildedrose/tests/GildedRoseTest.php`

This is the canonical Emily Bache kata adapted for French formation. The starter provides volontairement-moche legacy code that the stagiaire must refactor safely.

- [ ] **Step 1 : Create directory structure**

```bash
mkdir -p s3-gildedrose/src s3-gildedrose/tests
```

- [ ] **Step 2 : Create `s3-gildedrose/README.md` (règles précises du kata)**

```markdown
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
```

- [ ] **Step 3 : Create `s3-gildedrose/src/Item.php` (intouchable)**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

/**
 * Item est intouchable : sa signature est utilisée par le système Goblin externe.
 * Ne modifie ni les propriétés ni le constructeur.
 *
 * (Cette contrainte fait partie du kata original d'Emily Bache.)
 */
final class Item
{
    public function __construct(
        public string $name,
        public int $sellIn,
        public int $quality,
    ) {
    }

    public function __toString(): string
    {
        return $this->name . ', ' . $this->sellIn . ', ' . $this->quality;
    }
}
```

- [ ] **Step 4 : Create `s3-gildedrose/src/GildedRose.php` (legacy moche, original kata adapté)**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

/**
 * Code legacy hérité de l'ancien dev. Aucun test, beaucoup de conditions imbriquées.
 * Refactore-le, mais d'abord couvre-le avec des tests de caractérisation.
 */
final class GildedRose
{
    /** @param Item[] $items */
    public function __construct(private array $items)
    {
    }

    public function updateQuality(): void
    {
        for ($i = 0; $i < count($this->items); $i++) {
            if ($this->items[$i]->name !== 'Aged Brie' && $this->items[$i]->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                if ($this->items[$i]->quality > 0) {
                    if ($this->items[$i]->name !== 'Sulfuras, Hand of Ragnaros') {
                        $this->items[$i]->quality = $this->items[$i]->quality - 1;
                    }
                }
            } else {
                if ($this->items[$i]->quality < 50) {
                    $this->items[$i]->quality = $this->items[$i]->quality + 1;

                    if ($this->items[$i]->name === 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($this->items[$i]->sellIn < 11) {
                            if ($this->items[$i]->quality < 50) {
                                $this->items[$i]->quality = $this->items[$i]->quality + 1;
                            }
                        }
                        if ($this->items[$i]->sellIn < 6) {
                            if ($this->items[$i]->quality < 50) {
                                $this->items[$i]->quality = $this->items[$i]->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($this->items[$i]->name !== 'Sulfuras, Hand of Ragnaros') {
                $this->items[$i]->sellIn = $this->items[$i]->sellIn - 1;
            }

            if ($this->items[$i]->sellIn < 0) {
                if ($this->items[$i]->name !== 'Aged Brie') {
                    if ($this->items[$i]->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($this->items[$i]->quality > 0) {
                            if ($this->items[$i]->name !== 'Sulfuras, Hand of Ragnaros') {
                                $this->items[$i]->quality = $this->items[$i]->quality - 1;
                            }
                        }
                    } else {
                        $this->items[$i]->quality = $this->items[$i]->quality - $this->items[$i]->quality;
                    }
                } else {
                    if ($this->items[$i]->quality < 50) {
                        $this->items[$i]->quality = $this->items[$i]->quality + 1;
                    }
                }
            }
        }
    }

    /** @return Item[] */
    public function items(): array
    {
        return $this->items;
    }
}
```

- [ ] **Step 5 : Create `s3-gildedrose/src/Program.php` (démo simulant 30 jours)**

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use JDevelop\Exercises\Tdd\S3Gildedrose\GildedRose;
use JDevelop\Exercises\Tdd\S3Gildedrose\Item;

$items = [
    new Item(name: '+5 Dexterity Vest', sellIn: 10, quality: 20),
    new Item(name: 'Aged Brie', sellIn: 2, quality: 0),
    new Item(name: 'Elixir of the Mongoose', sellIn: 5, quality: 7),
    new Item(name: 'Sulfuras, Hand of Ragnaros', sellIn: 0, quality: 80),
    new Item(name: 'Sulfuras, Hand of Ragnaros', sellIn: -1, quality: 80),
    new Item(name: 'Backstage passes to a TAFKAL80ETC concert', sellIn: 15, quality: 20),
    new Item(name: 'Backstage passes to a TAFKAL80ETC concert', sellIn: 10, quality: 49),
    new Item(name: 'Backstage passes to a TAFKAL80ETC concert', sellIn: 5, quality: 49),
];

$days = 30;
if ($argc > 1) {
    $days = (int) $argv[1];
}

$gildedRose = new GildedRose($items);

for ($day = 0; $day < $days; $day++) {
    echo "-------- jour $day --------\n";
    echo "name, sellIn, quality\n";
    foreach ($gildedRose->items() as $item) {
        echo $item . "\n";
    }
    echo "\n";
    $gildedRose->updateQuality();
}
```

- [ ] **Step 6 : Create `s3-gildedrose/tests/GildedRoseTest.php` (placeholder)**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Atelier 3 : GildedRose Kata.
 *
 * Avant tout refactoring, écris des tests de caractérisation qui capturent
 * le comportement actuel pour chaque type d'objet :
 *
 *   - Standard items (ex. "+5 Dexterity Vest", "Elixir of the Mongoose")
 *   - "Aged Brie"
 *   - "Sulfuras, Hand of Ragnaros"
 *   - "Backstage passes to a TAFKAL80ETC concert"
 *
 * Couvre aussi les cas limites :
 *   - quality ne descend jamais sous 0
 *   - quality ne dépasse jamais 50 (sauf Sulfuras qui reste à 80)
 *   - après sellIn dépassée, quality diminue 2 fois plus vite (sauf cas spéciaux)
 *
 * Une fois ces tests verts, tu peux refactorer GildedRose en confiance.
 *
 * Enfin, ajoute le support des Conjured items (qui perdent quality 2x plus vite)
 * en TDD strict : test rouge, code minimal, refactor.
 */
final class GildedRoseTest extends TestCase
{
    #[Test]
    public function placeholder_a_remplacer_par_ton_premier_test_de_caracterisation(): void
    {
        $this->markTestSkipped('Atelier 3 : démarre par un test sur "+5 Dexterity Vest".');
    }
}
```

- [ ] **Step 7 : Verify the demo runs**

```bash
composer dump-autoload
php s3-gildedrose/src/Program.php 3
```

Expected : 3 days of output showing items state. No PHP errors.

- [ ] **Step 8 : Verify suite runs**

```bash
./vendor/bin/phpunit --testsuite s3-gildedrose
```

Expected : `OK, but some tests were skipped!`. 1 skipped.

- [ ] **Step 9 : Verify PHP syntax of all created files**

```bash
find s3-gildedrose -name "*.php" -exec php -l {} \;
```

Expected : `No syntax errors detected` for each file.

- [ ] **Step 10 : Run the full phpunit to verify nothing is broken**

```bash
./vendor/bin/phpunit
```

Expected : 3 skipped tests total (1 per atelier), 0 failed, 0 errored.

- [ ] **Step 11 : Commit**

```bash
git add s3-gildedrose/
git commit -m ":sparkles: feat(s3): add GildedRose kata starter (legacy + kata README)"
```

---

## Phase 3 : Documentation and CI

### Task 6 : Full README for participants

**Files:**
- Modify: `README.md`

- [ ] **Step 1 : Replace the stub `README.md` with the full participant-oriented README**

```markdown
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
```

- [ ] **Step 2 : Verify no em-dash or en-dash**

```bash
grep -n "—\|–" README.md && echo "FOUND" || echo "clean"
```

Expected : `clean`.

- [ ] **Step 3 : Commit**

```bash
git add README.md
git commit -m ":memo: docs: write full README for participants"
```

---

### Task 7 : GitHub Actions CI workflow

**Files:**
- Create: `.github/workflows/ci.yml`

- [ ] **Step 1 : Create directory**

```bash
mkdir -p .github/workflows
```

- [ ] **Step 2 : Create `.github/workflows/ci.yml`**

```yaml
name: CI

on:
  push:
    branches:
      - main
      - 'solutions/**'
  pull_request:
    branches:
      - main
      - 'solutions/**'

jobs:
  lint-php:
    name: Lint PHP
    runs-on: ubuntu-latest
    steps:
      - name: Checkout
        uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          tools: composer:v2
          coverage: none

      - name: Cache Composer dependencies
        uses: actions/cache@v4
        with:
          path: ~/.composer/cache
          key: composer-${{ runner.os }}-${{ hashFiles('composer.json') }}
          restore-keys: composer-${{ runner.os }}-

      - name: Validate composer.json
        run: composer validate --strict

      - name: Check PHP syntax
        run: |
          set -e
          find . -type f -name "*.php" -not -path "./vendor/*" -print0 | xargs -0 -n1 php -l

  test-solutions:
    name: Run PHPUnit (solutions branches only)
    runs-on: ubuntu-latest
    if: startsWith(github.ref, 'refs/heads/solutions/') || startsWith(github.head_ref, 'solutions/')
    steps:
      - name: Checkout
        uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          tools: composer:v2
          coverage: none

      - name: Cache Composer dependencies
        uses: actions/cache@v4
        with:
          path: ~/.composer/cache
          key: composer-${{ runner.os }}-${{ hashFiles('composer.json') }}
          restore-keys: composer-${{ runner.os }}-

      - name: Install dependencies
        run: composer install --no-progress --prefer-dist

      - name: Run PHPUnit
        run: ./vendor/bin/phpunit

  matrix-check:
    name: PHP compatibility (${{ matrix.php }})
    runs-on: ubuntu-latest
    if: startsWith(github.ref, 'refs/heads/solutions/') || startsWith(github.head_ref, 'solutions/')
    strategy:
      fail-fast: false
      matrix:
        php: ['8.2', '8.3']
    steps:
      - name: Checkout
        uses: actions/checkout@v4

      - name: Setup PHP ${{ matrix.php }}
        uses: shivammathur/setup-php@v2
        with:
          php-version: ${{ matrix.php }}
          tools: composer:v2
          coverage: none

      - name: Install dependencies
        run: composer install --no-progress --prefer-dist

      - name: Run PHPUnit
        run: ./vendor/bin/phpunit
```

- [ ] **Step 3 : Validate YAML syntax**

```bash
python3 -c "import yaml; yaml.safe_load(open('.github/workflows/ci.yml'))" && echo "YAML OK"
```

Expected : `YAML OK`.

- [ ] **Step 4 : Commit**

```bash
git add .github/workflows/ci.yml
git commit -m ":construction_worker: ci: add GitHub Actions workflow"
```

---

## Phase 4 : Publish

### Task 8 : Create the public GitHub repo and push main

**Files:** None.

- [ ] **Step 1 : Verify gh auth and org access**

```bash
gh auth status
gh api /user/orgs --jq '.[].login' | grep jdevelop-io
```

Expected : `jdevelop-io` appears.

- [ ] **Step 2 : Create the public repo and push main**

```bash
cd ~/Development/Contributions/exercises-tdd
gh repo create jdevelop-io/exercises-tdd \
  --public \
  --description "Starter code pour la formation JDevelop : TDD, concevoir par les tests." \
  --source=. \
  --remote=origin \
  --push
```

Expected : repo created, origin set, main pushed.

If push fails due to SSH agent, retry :

```bash
git push -u origin main
```

- [ ] **Step 3 : Verify**

```bash
gh repo view jdevelop-io/exercises-tdd --json url,visibility,description --jq '"URL: \(.url)\nVisibility: \(.visibility)\nDescription: \(.description)"'
```

Expected : URL, PUBLIC, description matches.

- [ ] **Step 4 : Wait for first CI run and verify**

```bash
sleep 30
gh run list --limit 1
```

Expected : `lint-php` job completes successfully (test-solutions and matrix-check are skipped on main).

---

## Phase 5 : Solutions branches

### Task 9 : `solutions/s1` branch with FizzBuzz reference solution

**Files:**
- Create: `s1-fizzbuzz/src/FizzBuzz.php`
- Modify: `s1-fizzbuzz/tests/FizzBuzzTest.php` (replace placeholder with 8 tests)

- [ ] **Step 1 : Create branch from main**

```bash
git checkout main
git checkout -b solutions/s1
```

- [ ] **Step 2 : Create `s1-fizzbuzz/src/FizzBuzz.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S1Fizzbuzz;

final class FizzBuzz
{
    public function say(int $n): string
    {
        if ($n % 15 === 0) {
            return 'FizzBuzz';
        }
        if ($n % 3 === 0) {
            return 'Fizz';
        }
        if ($n % 5 === 0) {
            return 'Buzz';
        }

        return (string) $n;
    }

    /** @return string[] */
    public function range(int $from, int $to): array
    {
        $result = [];
        for ($i = $from; $i <= $to; $i++) {
            $result[] = $this->say($i);
        }

        return $result;
    }
}
```

- [ ] **Step 3 : Replace `s1-fizzbuzz/tests/FizzBuzzTest.php` with 8 tests**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S1Fizzbuzz\Tests;

use JDevelop\Exercises\Tdd\S1Fizzbuzz\FizzBuzz;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FizzBuzzTest extends TestCase
{
    private FizzBuzz $fizzBuzz;

    protected function setUp(): void
    {
        $this->fizzBuzz = new FizzBuzz();
    }

    #[Test]
    public function test_say_returns_the_number_as_string_when_not_a_multiple(): void
    {
        $this->assertSame('1', $this->fizzBuzz->say(1));
        $this->assertSame('2', $this->fizzBuzz->say(2));
    }

    #[Test]
    public function test_say_returns_fizz_for_multiples_of_three(): void
    {
        $this->assertSame('Fizz', $this->fizzBuzz->say(3));
        $this->assertSame('Fizz', $this->fizzBuzz->say(6));
    }

    #[Test]
    public function test_say_returns_buzz_for_multiples_of_five(): void
    {
        $this->assertSame('Buzz', $this->fizzBuzz->say(5));
        $this->assertSame('Buzz', $this->fizzBuzz->say(10));
    }

    #[Test]
    public function test_say_returns_fizzbuzz_for_multiples_of_fifteen(): void
    {
        $this->assertSame('FizzBuzz', $this->fizzBuzz->say(15));
        $this->assertSame('FizzBuzz', $this->fizzBuzz->say(30));
    }

    #[Test]
    public function test_say_returns_fizz_for_nine(): void
    {
        $this->assertSame('Fizz', $this->fizzBuzz->say(9));
    }

    #[Test]
    public function test_say_returns_the_number_for_seven(): void
    {
        $this->assertSame('7', $this->fizzBuzz->say(7));
    }

    #[Test]
    public function test_range_returns_the_first_fifteen_results(): void
    {
        $expected = ['1', '2', 'Fizz', '4', 'Buzz', 'Fizz', '7', '8', 'Fizz', 'Buzz', '11', 'Fizz', '13', '14', 'FizzBuzz'];

        $this->assertSame($expected, $this->fizzBuzz->range(1, 15));
    }

    #[Test]
    public function test_range_one_to_one_returns_a_single_element(): void
    {
        $this->assertSame(['1'], $this->fizzBuzz->range(1, 1));
    }
}
```

- [ ] **Step 4 : Verify**

```bash
composer dump-autoload
./vendor/bin/phpunit --testsuite s1-fizzbuzz
```

Expected : `OK (8 tests, N assertions)`.

- [ ] **Step 5 : Commit and push**

```bash
git add s1-fizzbuzz/
git commit -m ":white_check_mark: test(s1): add FizzBuzz solution with 8 tests"
git push -u origin solutions/s1
```

- [ ] **Step 6 : Verify CI**

```bash
sleep 60
gh run list --branch solutions/s1 --limit 1
```

Expected : `completed success`.

---

### Task 10 : `solutions/s2` branch with BankAccount hexagonal solution

**Files:**
- Modify: `s2-bank-account/src/Account.php`
- Create: `s2-bank-account/src/Money.php`
- Create: `s2-bank-account/src/InsufficientFundsException.php`
- Modify: `s2-bank-account/src/AccountRepository.php` (already exists, verify)
- Create: `s2-bank-account/src/InMemoryAccountRepository.php`
- Create: `s2-bank-account/src/TransferUseCase.php`
- Create: `s2-bank-account/src/AccountNotFoundException.php`
- Modify: `s2-bank-account/tests/AccountTest.php` (replace placeholder with full tests)
- Create: `s2-bank-account/tests/TransferUseCaseTest.php`

- [ ] **Step 1 : Create branch from main**

```bash
git checkout main
git checkout -b solutions/s2
```

- [ ] **Step 2 : Replace `s2-bank-account/src/Account.php` with full implementation**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

final class Account
{
    public function __construct(
        public readonly string $id,
        private int $balance = 0,
    ) {
    }

    public function balance(): int
    {
        return $this->balance;
    }

    public function deposit(int $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Le montant déposé doit être positif.');
        }

        $this->balance += $amount;
    }

    public function withdraw(int $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Le montant retiré doit être positif.');
        }

        if ($amount > $this->balance) {
            throw new InsufficientFundsException(
                "Solde insuffisant : tentative de retrait de $amount, solde actuel $this->balance.",
            );
        }

        $this->balance -= $amount;
    }
}
```

- [ ] **Step 3 : Create `s2-bank-account/src/InsufficientFundsException.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

use DomainException;

final class InsufficientFundsException extends DomainException
{
}
```

- [ ] **Step 4 : Create `s2-bank-account/src/AccountNotFoundException.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

use DomainException;

final class AccountNotFoundException extends DomainException
{
}
```

- [ ] **Step 5 : Create `s2-bank-account/src/InMemoryAccountRepository.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

final class InMemoryAccountRepository implements AccountRepository
{
    /** @var array<string, Account> */
    private array $accounts = [];

    public function save(Account $account): void
    {
        $this->accounts[$account->id] = $account;
    }

    public function findById(string $id): ?Account
    {
        return $this->accounts[$id] ?? null;
    }
}
```

- [ ] **Step 6 : Create `s2-bank-account/src/TransferUseCase.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

final class TransferUseCase
{
    public function __construct(
        private readonly AccountRepository $accounts,
    ) {
    }

    public function execute(string $fromId, string $toId, int $amount): void
    {
        $from = $this->accounts->findById($fromId);
        if ($from === null) {
            throw new AccountNotFoundException("Compte source introuvable : $fromId.");
        }

        $to = $this->accounts->findById($toId);
        if ($to === null) {
            throw new AccountNotFoundException("Compte destinataire introuvable : $toId.");
        }

        $from->withdraw($amount);
        $to->deposit($amount);

        $this->accounts->save($from);
        $this->accounts->save($to);
    }
}
```

- [ ] **Step 7 : Replace `s2-bank-account/tests/AccountTest.php` with 6 tests**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount\Tests;

use InvalidArgumentException;
use JDevelop\Exercises\Tdd\S2BankAccount\Account;
use JDevelop\Exercises\Tdd\S2BankAccount\InsufficientFundsException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AccountTest extends TestCase
{
    #[Test]
    public function test_a_new_account_starts_with_a_zero_balance(): void
    {
        $account = new Account(id: 'acc-1');

        $this->assertSame(0, $account->balance());
    }

    #[Test]
    public function test_deposit_adds_the_amount_to_the_balance(): void
    {
        $account = new Account(id: 'acc-1');

        $account->deposit(100);

        $this->assertSame(100, $account->balance());
    }

    #[Test]
    public function test_withdraw_subtracts_the_amount_from_the_balance(): void
    {
        $account = new Account(id: 'acc-1', balance: 100);

        $account->withdraw(40);

        $this->assertSame(60, $account->balance());
    }

    #[Test]
    public function test_withdraw_more_than_balance_throws_insufficient_funds(): void
    {
        $account = new Account(id: 'acc-1', balance: 50);

        $this->expectException(InsufficientFundsException::class);

        $account->withdraw(100);
    }

    #[Test]
    public function test_deposit_negative_amount_throws_invalid_argument(): void
    {
        $account = new Account(id: 'acc-1');

        $this->expectException(InvalidArgumentException::class);

        $account->deposit(-10);
    }

    #[Test]
    public function test_withdraw_negative_amount_throws_invalid_argument(): void
    {
        $account = new Account(id: 'acc-1', balance: 100);

        $this->expectException(InvalidArgumentException::class);

        $account->withdraw(-10);
    }
}
```

- [ ] **Step 8 : Create `s2-bank-account/tests/TransferUseCaseTest.php` with 4 tests**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount\Tests;

use JDevelop\Exercises\Tdd\S2BankAccount\Account;
use JDevelop\Exercises\Tdd\S2BankAccount\AccountNotFoundException;
use JDevelop\Exercises\Tdd\S2BankAccount\InMemoryAccountRepository;
use JDevelop\Exercises\Tdd\S2BankAccount\InsufficientFundsException;
use JDevelop\Exercises\Tdd\S2BankAccount\TransferUseCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TransferUseCaseTest extends TestCase
{
    private InMemoryAccountRepository $accounts;
    private TransferUseCase $transfer;

    protected function setUp(): void
    {
        $this->accounts = new InMemoryAccountRepository();
        $this->transfer = new TransferUseCase($this->accounts);
    }

    #[Test]
    public function test_transfer_moves_money_from_source_to_destination(): void
    {
        $from = new Account(id: 'acc-from', balance: 200);
        $to = new Account(id: 'acc-to', balance: 50);
        $this->accounts->save($from);
        $this->accounts->save($to);

        $this->transfer->execute('acc-from', 'acc-to', 75);

        $this->assertSame(125, $this->accounts->findById('acc-from')->balance());
        $this->assertSame(125, $this->accounts->findById('acc-to')->balance());
    }

    #[Test]
    public function test_transfer_with_insufficient_funds_throws_and_does_not_credit_destination(): void
    {
        $from = new Account(id: 'acc-from', balance: 50);
        $to = new Account(id: 'acc-to', balance: 0);
        $this->accounts->save($from);
        $this->accounts->save($to);

        try {
            $this->transfer->execute('acc-from', 'acc-to', 100);
            $this->fail('Expected InsufficientFundsException');
        } catch (InsufficientFundsException) {
            $this->assertSame(50, $this->accounts->findById('acc-from')->balance());
            $this->assertSame(0, $this->accounts->findById('acc-to')->balance());
        }
    }

    #[Test]
    public function test_transfer_from_unknown_account_throws_account_not_found(): void
    {
        $to = new Account(id: 'acc-to');
        $this->accounts->save($to);

        $this->expectException(AccountNotFoundException::class);

        $this->transfer->execute('acc-unknown', 'acc-to', 50);
    }

    #[Test]
    public function test_transfer_to_unknown_account_throws_account_not_found(): void
    {
        $from = new Account(id: 'acc-from', balance: 100);
        $this->accounts->save($from);

        $this->expectException(AccountNotFoundException::class);

        $this->transfer->execute('acc-from', 'acc-unknown', 50);
    }
}
```

- [ ] **Step 9 : Verify**

```bash
composer dump-autoload
./vendor/bin/phpunit --testsuite s2-bank-account
```

Expected : `OK (10 tests, N assertions)`.

- [ ] **Step 10 : Commit and push**

```bash
git add s2-bank-account/
git commit -m ":sparkles: test(s2): add BankAccount solution (Account + Transfer use case + 10 tests)"
git push -u origin solutions/s2
```

- [ ] **Step 11 : Verify CI**

```bash
sleep 60
gh run list --branch solutions/s2 --limit 1
```

Expected : `completed success`.

---

### Task 11 : `solutions/s3` branch with GildedRose refactored + Conjured items

**Files:**
- Modify: `s3-gildedrose/src/GildedRose.php` (replace with refactored version using Strategy)
- Create: `s3-gildedrose/src/UpdateStrategy.php` (interface)
- Create: `s3-gildedrose/src/StandardItemStrategy.php`
- Create: `s3-gildedrose/src/AgedBrieStrategy.php`
- Create: `s3-gildedrose/src/SulfurasStrategy.php`
- Create: `s3-gildedrose/src/BackstagePassStrategy.php`
- Create: `s3-gildedrose/src/ConjuredItemStrategy.php`
- Create: `s3-gildedrose/src/StrategyFactory.php`
- Modify: `s3-gildedrose/tests/GildedRoseTest.php` (replace with caractérisation + Conjured tests)

- [ ] **Step 1 : Create branch from main**

```bash
git checkout main
git checkout -b solutions/s3
```

- [ ] **Step 2 : Create `s3-gildedrose/src/UpdateStrategy.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

interface UpdateStrategy
{
    public function update(Item $item): void;
}
```

- [ ] **Step 3 : Create `s3-gildedrose/src/StandardItemStrategy.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

final class StandardItemStrategy implements UpdateStrategy
{
    private const MIN_QUALITY = 0;

    public function update(Item $item): void
    {
        $degradation = $item->sellIn <= 0 ? 2 : 1;
        $item->quality = max(self::MIN_QUALITY, $item->quality - $degradation);
        $item->sellIn -= 1;
    }
}
```

- [ ] **Step 4 : Create `s3-gildedrose/src/AgedBrieStrategy.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

final class AgedBrieStrategy implements UpdateStrategy
{
    private const MAX_QUALITY = 50;

    public function update(Item $item): void
    {
        $increment = $item->sellIn <= 0 ? 2 : 1;
        $item->quality = min(self::MAX_QUALITY, $item->quality + $increment);
        $item->sellIn -= 1;
    }
}
```

- [ ] **Step 5 : Create `s3-gildedrose/src/SulfurasStrategy.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

final class SulfurasStrategy implements UpdateStrategy
{
    public function update(Item $item): void
    {
        // Sulfuras est légendaire : ni sellIn ni quality ne changent jamais.
    }
}
```

- [ ] **Step 6 : Create `s3-gildedrose/src/BackstagePassStrategy.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

final class BackstagePassStrategy implements UpdateStrategy
{
    private const MAX_QUALITY = 50;

    public function update(Item $item): void
    {
        if ($item->sellIn <= 0) {
            $item->quality = 0;
        } elseif ($item->sellIn <= 5) {
            $item->quality = min(self::MAX_QUALITY, $item->quality + 3);
        } elseif ($item->sellIn <= 10) {
            $item->quality = min(self::MAX_QUALITY, $item->quality + 2);
        } else {
            $item->quality = min(self::MAX_QUALITY, $item->quality + 1);
        }

        $item->sellIn -= 1;
    }
}
```

- [ ] **Step 7 : Create `s3-gildedrose/src/ConjuredItemStrategy.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

final class ConjuredItemStrategy implements UpdateStrategy
{
    private const MIN_QUALITY = 0;

    public function update(Item $item): void
    {
        $degradation = $item->sellIn <= 0 ? 4 : 2;
        $item->quality = max(self::MIN_QUALITY, $item->quality - $degradation);
        $item->sellIn -= 1;
    }
}
```

- [ ] **Step 8 : Create `s3-gildedrose/src/StrategyFactory.php`**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

final class StrategyFactory
{
    public static function for(Item $item): UpdateStrategy
    {
        return match (true) {
            $item->name === 'Aged Brie' => new AgedBrieStrategy(),
            $item->name === 'Sulfuras, Hand of Ragnaros' => new SulfurasStrategy(),
            $item->name === 'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassStrategy(),
            str_starts_with($item->name, 'Conjured') => new ConjuredItemStrategy(),
            default => new StandardItemStrategy(),
        };
    }
}
```

- [ ] **Step 9 : Replace `s3-gildedrose/src/GildedRose.php` with the clean version**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

final class GildedRose
{
    /** @param Item[] $items */
    public function __construct(private array $items)
    {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            StrategyFactory::for($item)->update($item);
        }
    }

    /** @return Item[] */
    public function items(): array
    {
        return $this->items;
    }
}
```

- [ ] **Step 10 : Replace `s3-gildedrose/tests/GildedRoseTest.php` with caractérisation tests + Conjured items**

```php
<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose\Tests;

use JDevelop\Exercises\Tdd\S3Gildedrose\GildedRose;
use JDevelop\Exercises\Tdd\S3Gildedrose\Item;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase
{
    private function updateOnce(Item $item): Item
    {
        $rose = new GildedRose([$item]);
        $rose->updateQuality();

        return $rose->items()[0];
    }

    #[Test]
    public function test_standard_item_decreases_sellin_and_quality_by_one_per_day(): void
    {
        $item = $this->updateOnce(new Item('+5 Dexterity Vest', sellIn: 10, quality: 20));

        $this->assertSame(9, $item->sellIn);
        $this->assertSame(19, $item->quality);
    }

    #[Test]
    public function test_standard_item_quality_decreases_twice_as_fast_after_sellin(): void
    {
        $item = $this->updateOnce(new Item('+5 Dexterity Vest', sellIn: 0, quality: 10));

        $this->assertSame(-1, $item->sellIn);
        $this->assertSame(8, $item->quality);
    }

    #[Test]
    public function test_quality_never_goes_below_zero(): void
    {
        $item = $this->updateOnce(new Item('+5 Dexterity Vest', sellIn: 5, quality: 0));

        $this->assertSame(0, $item->quality);
    }

    #[Test]
    public function test_aged_brie_quality_increases_with_time(): void
    {
        $item = $this->updateOnce(new Item('Aged Brie', sellIn: 5, quality: 10));

        $this->assertSame(11, $item->quality);
    }

    #[Test]
    public function test_quality_never_exceeds_fifty(): void
    {
        $item = $this->updateOnce(new Item('Aged Brie', sellIn: 5, quality: 50));

        $this->assertSame(50, $item->quality);
    }

    #[Test]
    public function test_sulfuras_never_changes(): void
    {
        $item = $this->updateOnce(new Item('Sulfuras, Hand of Ragnaros', sellIn: 0, quality: 80));

        $this->assertSame(0, $item->sellIn);
        $this->assertSame(80, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_increase_by_one_more_than_ten_days_left(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 15, quality: 20));

        $this->assertSame(21, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_increase_by_two_when_ten_days_or_less(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 10, quality: 20));

        $this->assertSame(22, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_increase_by_three_when_five_days_or_less(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 5, quality: 20));

        $this->assertSame(23, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_drop_to_zero_after_concert(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 0, quality: 30));

        $this->assertSame(0, $item->quality);
    }

    #[Test]
    public function test_conjured_item_decreases_quality_twice_as_fast(): void
    {
        $item = $this->updateOnce(new Item('Conjured Mana Cake', sellIn: 5, quality: 10));

        $this->assertSame(8, $item->quality);
    }

    #[Test]
    public function test_conjured_item_after_sellin_decreases_four_times_normal(): void
    {
        $item = $this->updateOnce(new Item('Conjured Mana Cake', sellIn: 0, quality: 10));

        $this->assertSame(6, $item->quality);
    }
}
```

- [ ] **Step 11 : Verify**

```bash
composer dump-autoload
./vendor/bin/phpunit --testsuite s3-gildedrose
```

Expected : `OK (12 tests, N assertions)`.

- [ ] **Step 12 : Run the full phpunit suite to verify nothing else is broken on this branch**

```bash
./vendor/bin/phpunit
```

Expected : s1 skipped (1), s2 skipped (1), s3 passing (12). Total 14 tests, 2 skipped.

- [ ] **Step 13 : Commit and push**

```bash
git add s3-gildedrose/
git commit -m ":recycle: refactor(s3): GildedRose with Strategy pattern + Conjured items support (12 tests)"
git push -u origin solutions/s3
```

- [ ] **Step 14 : Verify CI**

```bash
sleep 60
gh run list --branch solutions/s3 --limit 1
```

Expected : `completed success`.

---

## Phase 6 : Final validation

### Task 12 : Final validation and return to main

**Files:** None.

- [ ] **Step 1 : Return to main and verify clean state**

```bash
git checkout main
git status
git branch -a
```

Expected : on `main`, clean tree, all 3 `solutions/*` branches visible both locally and remote.

- [ ] **Step 2 : Verify all CI runs are green**

```bash
gh run list --limit 8
```

Expected : recent runs for main + 3 solutions branches all show `completed success`.

- [ ] **Step 3 : Verify repo metadata**

```bash
gh repo view jdevelop-io/exercises-tdd --json url,visibility,description,defaultBranchRef
```

Expected : URL public, defaultBranchRef.name `main`.

- [ ] **Step 4 : Sanity clone in /tmp**

```bash
cd /tmp
rm -rf exercises-tdd-verify
git clone https://github.com/jdevelop-io/exercises-tdd.git exercises-tdd-verify
cd exercises-tdd-verify
composer install
./vendor/bin/phpunit
```

Expected : 3 skipped tests (1 per atelier), 0 failed.

- [ ] **Step 5 : No commit (validation only).**

Plan C complete. The repo is live at `https://github.com/jdevelop-io/exercises-tdd`. Plan B (content authoring) can now reference the 3 ateliers.

---

## Self-review (performed)

**Spec coverage check** :

| Spec section | Covered by tasks |
|---|---|
| §1 Contexte | README (Task 6) |
| §2 Décisions cadrage (1-9) | Style rules + task instructions |
| §3 Structure (exercises-tdd) | Tasks 1 to 5 (file structure) + Task 8 (publish) |
| §4-6 Outline sessions | Out of scope for Plan C, covered by Plan B later |
| §7 Conventions héritées | Style rules section (referenced by all tasks) |
| §8 Workflow Plan C | Tasks 1 to 11 (matches §8 Plan C steps 1-11) |
| §9 Critères validation exercises | Task 12 (final verification) |
| §10 Hors scope | Respected |
| §11 Cleanup pre-merge | Out of scope for Plan C, applies at merge time |
| §12 Questions ouvertes | Q4 (README GildedRose en français) addressed in Task 5 step 2 |

**Placeholder scan** : no TBD/TODO. All code blocks complete. All commands explicit.

**Type consistency** :
- `JDevelop\Exercises\Tdd\S1Fizzbuzz\` namespace consistent (FizzBuzz class + FizzBuzzTest namespace)
- `JDevelop\Exercises\Tdd\S2BankAccount\` namespace consistent (Account, AccountRepository, InMemoryAccountRepository, etc.)
- `JDevelop\Exercises\Tdd\S3Gildedrose\` namespace consistent (Item, GildedRose, all strategies)
- Method signatures consistent : `Account::balance()` returns int, `Account::deposit(int)` and `withdraw(int)` are void, throw exceptions
- `UpdateStrategy::update(Item)` consistent across 5 implementations

---

## Execution handoff

Plan complete and saved to `~/Development/Contributions/exercises-tdd/.claude/superpowers/plans/2026-04-18-plan-c-exercises-tdd.md`.

**Two execution options** :

1. **Subagent-Driven (recommended)** : dispatch fresh subagent per task, two-stage review.
2. **Inline Execution** : execute tasks in this session.

**Which approach?**
