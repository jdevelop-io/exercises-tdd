<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S1Fizzbuzz\Tests;

use JDevelop\Exercises\Tdd\S1Fizzbuzz\FizzBuzz;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FizzBuzzTest extends TestCase
{
    private FizzBuzz $fizzBuzz;

    protected function setUp(): void
    {
        $this->fizzBuzz = new FizzBuzz();
    }

    #[Test]
    public function test_say_returns_the_number_as_string_when_not_a_multiple(): void
    {
        $this->assertSame('1', $this->fizzBuzz->say(1));
        $this->assertSame('2', $this->fizzBuzz->say(2));
    }

    #[Test]
    public function test_say_returns_fizz_for_multiples_of_three(): void
    {
        $this->assertSame('Fizz', $this->fizzBuzz->say(3));
        $this->assertSame('Fizz', $this->fizzBuzz->say(6));
    }

    #[Test]
    public function test_say_returns_buzz_for_multiples_of_five(): void
    {
        $this->assertSame('Buzz', $this->fizzBuzz->say(5));
        $this->assertSame('Buzz', $this->fizzBuzz->say(10));
    }

    #[Test]
    public function test_say_returns_fizzbuzz_for_multiples_of_fifteen(): void
    {
        $this->assertSame('FizzBuzz', $this->fizzBuzz->say(15));
        $this->assertSame('FizzBuzz', $this->fizzBuzz->say(30));
    }

    #[Test]
    public function test_say_returns_fizz_for_nine(): void
    {
        $this->assertSame('Fizz', $this->fizzBuzz->say(9));
    }

    #[Test]
    public function test_say_returns_the_number_for_seven(): void
    {
        $this->assertSame('7', $this->fizzBuzz->say(7));
    }

    #[Test]
    public function test_range_returns_the_first_fifteen_results(): void
    {
        $expected = ['1', '2', 'Fizz', '4', 'Buzz', 'Fizz', '7', '8', 'Fizz', 'Buzz', '11', 'Fizz', '13', '14', 'FizzBuzz'];

        $this->assertSame($expected, $this->fizzBuzz->range(1, 15));
    }

    #[Test]
    public function test_range_one_to_one_returns_a_single_element(): void
    {
        $this->assertSame(['1'], $this->fizzBuzz->range(1, 1));
    }
}
