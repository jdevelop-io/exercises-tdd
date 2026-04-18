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
