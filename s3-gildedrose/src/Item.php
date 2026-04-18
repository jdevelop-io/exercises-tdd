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
