<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

final class InMemoryAccountRepository implements AccountRepository
{
    /** @var array<string, Account> */
    private array $accounts = [];

    public function save(Account $account): void
    {
        $this->accounts[$account->id] = $account;
    }

    public function findById(string $id): ?Account
    {
        return $this->accounts[$id] ?? null;
    }
}
