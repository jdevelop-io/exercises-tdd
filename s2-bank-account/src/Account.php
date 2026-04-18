<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

use InvalidArgumentException;

final class Account
{
    public function __construct(
        public readonly string $id,
        private int $balance = 0,
    ) {
    }

    public function balance(): int
    {
        return $this->balance;
    }

    public function deposit(int $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Le montant déposé doit être positif.');
        }

        $this->balance += $amount;
    }

    public function withdraw(int $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Le montant retiré doit être positif.');
        }

        if ($amount > $this->balance) {
            throw new InsufficientFundsException(
                "Solde insuffisant : tentative de retrait de $amount, solde actuel $this->balance.",
            );
        }

        $this->balance -= $amount;
    }
}
