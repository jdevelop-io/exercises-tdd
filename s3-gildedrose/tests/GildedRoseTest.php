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
