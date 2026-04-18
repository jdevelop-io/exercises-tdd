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
