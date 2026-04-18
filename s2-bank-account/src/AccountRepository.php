<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

/**
 * Port (interface) pour persister les Accounts.
 *
 * Implémente une version en mémoire (InMemoryAccountRepository) pour les tests.
 * Une implémentation Postgres ou DynamoDB serait un adapter de production.
 */
interface AccountRepository
{
    public function save(Account $account): void;

    public function findById(string $id): ?Account;
}
