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
