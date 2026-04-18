<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Atelier 2 : Bank Account avec architecture hexagonale.
 *
 * Étapes suggérées en TDD :
 *
 *   1. Account.deposit() : commencer par "deposit(100) sur solde 0 donne 100"
 *   2. Account.withdraw() : "withdraw(50) sur solde 100 donne 50"
 *   3. Cas limite withdraw : "withdraw plus que le solde lève InsufficientFundsException"
 *   4. AccountRepository : implémenter InMemoryAccountRepository, tester save / findById
 *   5. TransferUseCase : créer le use case qui transfère entre 2 comptes en utilisant le repo
 *
 * Discipline hexagonale :
 *   - Le domaine (Account, Money si tu en crées un) ne connait pas le repo
 *   - Le use case orchestre via les ports (AccountRepository en interface)
 *   - Les tests utilisent l'InMemoryAccountRepository comme fake
 *   - Pas de mocks (école Detroit), uniquement des fakes en mémoire
 *
 * Crée tes fichiers dans `s2-bank-account/src/` selon les besoins.
 */
final class AccountTest extends TestCase
{
    #[Test]
    public function placeholder_a_remplacer_par_ton_premier_test(): void
    {
        $this->markTestSkipped('Atelier 2 : démarre par "deposit ajoute le montant au solde".');
    }
}
