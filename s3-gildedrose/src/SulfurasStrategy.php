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
