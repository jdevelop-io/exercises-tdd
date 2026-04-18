<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount\Tests;

use InvalidArgumentException;
use JDevelop\Exercises\Tdd\S2BankAccount\Account;
use JDevelop\Exercises\Tdd\S2BankAccount\InsufficientFundsException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AccountTest extends TestCase
{
    #[Test]
    public function test_a_new_account_starts_with_a_zero_balance(): void
    {
        $account = new Account(id: 'acc-1');

        $this->assertSame(0, $account->balance());
    }

    #[Test]
    public function test_deposit_adds_the_amount_to_the_balance(): void
    {
        $account = new Account(id: 'acc-1');

        $account->deposit(100);

        $this->assertSame(100, $account->balance());
    }

    #[Test]
    public function test_withdraw_subtracts_the_amount_from_the_balance(): void
    {
        $account = new Account(id: 'acc-1', balance: 100);

        $account->withdraw(40);

        $this->assertSame(60, $account->balance());
    }

    #[Test]
    public function test_withdraw_more_than_balance_throws_insufficient_funds(): void
    {
        $account = new Account(id: 'acc-1', balance: 50);

        $this->expectException(InsufficientFundsException::class);

        $account->withdraw(100);
    }

    #[Test]
    public function test_deposit_negative_amount_throws_invalid_argument(): void
    {
        $account = new Account(id: 'acc-1');

        $this->expectException(InvalidArgumentException::class);

        $account->deposit(-10);
    }

    #[Test]
    public function test_withdraw_negative_amount_throws_invalid_argument(): void
    {
        $account = new Account(id: 'acc-1', balance: 100);

        $this->expectException(InvalidArgumentException::class);

        $account->withdraw(-10);
    }
}
