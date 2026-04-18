<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

/**
 * Atelier 2 : Account squelette à étoffer.
 *
 * À implémenter en TDD :
 *   - deposit(int $amount) : ajoute au solde, lève une exception si négatif
 *   - withdraw(int $amount) : retire du solde, lève une exception si négatif ou solde insuffisant
 *   - balance() : retourne le solde actuel
 *
 * Pas de Money value object au démarrage (utilise int en centimes pour simplifier).
 * Tu peux extraire un Money plus tard si tu veux explorer les value objects.
 */
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

    // À implémenter :
    // public function deposit(int $amount): void { ... }
    // public function withdraw(int $amount): void { ... }
}
