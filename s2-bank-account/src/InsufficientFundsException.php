<?php

declare(strict_types=1);

namespace JDevelop\Exercises\Tdd\S2BankAccount;

use DomainException;

final class InsufficientFundsException extends DomainException
{
}
