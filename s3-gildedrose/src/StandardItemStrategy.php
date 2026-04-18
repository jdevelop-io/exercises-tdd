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
