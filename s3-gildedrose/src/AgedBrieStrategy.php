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
