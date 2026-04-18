<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount\Tests;

use JDevelop\Exercises\Tdd\S2BankAccount\Account;
use JDevelop\Exercises\Tdd\S2BankAccount\AccountNotFoundException;
use JDevelop\Exercises\Tdd\S2BankAccount\InMemoryAccountRepository;
use JDevelop\Exercises\Tdd\S2BankAccount\InsufficientFundsException;
use JDevelop\Exercises\Tdd\S2BankAccount\TransferUseCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TransferUseCaseTest extends TestCase
{
    private InMemoryAccountRepository $accounts;
    private TransferUseCase $transfer;

    protected function setUp(): void
    {
        $this->accounts = new InMemoryAccountRepository();
        $this->transfer = new TransferUseCase($this->accounts);
    }

    #[Test]
    public function test_transfer_moves_money_from_source_to_destination(): void
    {
        $from = new Account(id: 'acc-from', balance: 200);
        $to = new Account(id: 'acc-to', balance: 50);
        $this->accounts->save($from);
        $this->accounts->save($to);

        $this->transfer->execute('acc-from', 'acc-to', 75);

        $this->assertSame(125, $this->accounts->findById('acc-from')->balance());
        $this->assertSame(125, $this->accounts->findById('acc-to')->balance());
    }

    #[Test]
    public function test_transfer_with_insufficient_funds_throws_and_does_not_credit_destination(): void
    {
        $from = new Account(id: 'acc-from', balance: 50);
        $to = new Account(id: 'acc-to', balance: 0);
        $this->accounts->save($from);
        $this->accounts->save($to);

        try {
            $this->transfer->execute('acc-from', 'acc-to', 100);
            $this->fail('Expected InsufficientFundsException');
        } catch (InsufficientFundsException) {
            $this->assertSame(50, $this->accounts->findById('acc-from')->balance());
            $this->assertSame(0, $this->accounts->findById('acc-to')->balance());
        }
    }

    #[Test]
    public function test_transfer_from_unknown_account_throws_account_not_found(): void
    {
        $to = new Account(id: 'acc-to');
        $this->accounts->save($to);

        $this->expectException(AccountNotFoundException::class);

        $this->transfer->execute('acc-unknown', 'acc-to', 50);
    }

    #[Test]
    public function test_transfer_to_unknown_account_throws_account_not_found(): void
    {
        $from = new Account(id: 'acc-from', balance: 100);
        $this->accounts->save($from);

        $this->expectException(AccountNotFoundException::class);

        $this->transfer->execute('acc-from', 'acc-unknown', 50);
    }
}
