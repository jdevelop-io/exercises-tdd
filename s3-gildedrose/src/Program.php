<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use JDevelop\Exercises\Tdd\S3Gildedrose\GildedRose;
use JDevelop\Exercises\Tdd\S3Gildedrose\Item;

$items = [
    new Item(name: '+5 Dexterity Vest', sellIn: 10, quality: 20),
    new Item(name: 'Aged Brie', sellIn: 2, quality: 0),
    new Item(name: 'Elixir of the Mongoose', sellIn: 5, quality: 7),
    new Item(name: 'Sulfuras, Hand of Ragnaros', sellIn: 0, quality: 80),
    new Item(name: 'Sulfuras, Hand of Ragnaros', sellIn: -1, quality: 80),
    new Item(name: 'Backstage passes to a TAFKAL80ETC concert', sellIn: 15, quality: 20),
    new Item(name: 'Backstage passes to a TAFKAL80ETC concert', sellIn: 10, quality: 49),
    new Item(name: 'Backstage passes to a TAFKAL80ETC concert', sellIn: 5, quality: 49),
];

$days = 30;
if ($argc > 1) {
    $days = (int) $argv[1];
}

$gildedRose = new GildedRose($items);

for ($day = 0; $day < $days; $day++) {
    echo "-------- jour $day --------\n";
    echo "name, sellIn, quality\n";
    foreach ($gildedRose->items() as $item) {
        echo $item . "\n";
    }
    echo "\n";
    $gildedRose->updateQuality();
}
