<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S1Fizzbuzz;

final class FizzBuzz
{
    public function say(int $n): string
    {
        if ($n % 15 === 0) {
            return 'FizzBuzz';
        }
        if ($n % 3 === 0) {
            return 'Fizz';
        }
        if ($n % 5 === 0) {
            return 'Buzz';
        }

        return (string) $n;
    }

    /** @return string[] */
    public function range(int $from, int $to): array
    {
        $result = [];
        for ($i = $from; $i <= $to; $i++) {
            $result[] = $this->say($i);
        }

        return $result;
    }
}
