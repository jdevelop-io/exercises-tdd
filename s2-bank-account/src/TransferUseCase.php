<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

final class TransferUseCase
{
    public function __construct(
        private readonly AccountRepository $accounts,
    ) {
    }

    public function execute(string $fromId, string $toId, int $amount): void
    {
        $from = $this->accounts->findById($fromId);
        if ($from === null) {
            throw new AccountNotFoundException("Compte source introuvable : $fromId.");
        }

        $to = $this->accounts->findById($toId);
        if ($to === null) {
            throw new AccountNotFoundException("Compte destinataire introuvable : $toId.");
        }

        $from->withdraw($amount);
        $to->deposit($amount);

        $this->accounts->save($from);
        $this->accounts->save($to);
    }
}
