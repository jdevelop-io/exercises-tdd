<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose\Tests;

use JDevelop\Exercises\Tdd\S3Gildedrose\GildedRose;
use JDevelop\Exercises\Tdd\S3Gildedrose\Item;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase
{
    private function updateOnce(Item $item): Item
    {
        $rose = new GildedRose([$item]);
        $rose->updateQuality();

        return $rose->items()[0];
    }

    #[Test]
    public function test_standard_item_decreases_sellin_and_quality_by_one_per_day(): void
    {
        $item = $this->updateOnce(new Item('+5 Dexterity Vest', sellIn: 10, quality: 20));

        $this->assertSame(9, $item->sellIn);
        $this->assertSame(19, $item->quality);
    }

    #[Test]
    public function test_standard_item_quality_decreases_twice_as_fast_after_sellin(): void
    {
        $item = $this->updateOnce(new Item('+5 Dexterity Vest', sellIn: 0, quality: 10));

        $this->assertSame(-1, $item->sellIn);
        $this->assertSame(8, $item->quality);
    }

    #[Test]
    public function test_quality_never_goes_below_zero(): void
    {
        $item = $this->updateOnce(new Item('+5 Dexterity Vest', sellIn: 5, quality: 0));

        $this->assertSame(0, $item->quality);
    }

    #[Test]
    public function test_aged_brie_quality_increases_with_time(): void
    {
        $item = $this->updateOnce(new Item('Aged Brie', sellIn: 5, quality: 10));

        $this->assertSame(11, $item->quality);
    }

    #[Test]
    public function test_quality_never_exceeds_fifty(): void
    {
        $item = $this->updateOnce(new Item('Aged Brie', sellIn: 5, quality: 50));

        $this->assertSame(50, $item->quality);
    }

    #[Test]
    public function test_sulfuras_never_changes(): void
    {
        $item = $this->updateOnce(new Item('Sulfuras, Hand of Ragnaros', sellIn: 0, quality: 80));

        $this->assertSame(0, $item->sellIn);
        $this->assertSame(80, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_increase_by_one_more_than_ten_days_left(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 15, quality: 20));

        $this->assertSame(21, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_increase_by_two_when_ten_days_or_less(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 10, quality: 20));

        $this->assertSame(22, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_increase_by_three_when_five_days_or_less(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 5, quality: 20));

        $this->assertSame(23, $item->quality);
    }

    #[Test]
    public function test_backstage_passes_drop_to_zero_after_concert(): void
    {
        $item = $this->updateOnce(new Item('Backstage passes to a TAFKAL80ETC concert', sellIn: 0, quality: 30));

        $this->assertSame(0, $item->quality);
    }

    #[Test]
    public function test_conjured_item_decreases_quality_twice_as_fast(): void
    {
        $item = $this->updateOnce(new Item('Conjured Mana Cake', sellIn: 5, quality: 10));

        $this->assertSame(8, $item->quality);
    }

    #[Test]
    public function test_conjured_item_after_sellin_decreases_four_times_normal(): void
    {
        $item = $this->updateOnce(new Item('Conjured Mana Cake', sellIn: 0, quality: 10));

        $this->assertSame(6, $item->quality);
    }
}
