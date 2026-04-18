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
