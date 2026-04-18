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
