<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S3Gildedrose;

interface UpdateStrategy
{
    public function update(Item $item): void;
}
