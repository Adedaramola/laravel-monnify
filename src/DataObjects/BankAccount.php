<?php

declare(strict_types=1);

namespace Adedaramola\Monnify\DataObjects;

class BankAccount
{
    public function __construct(
        public readonly string $accountNumber,
        public readonly string $accountName,
        public readonly string $bankCode,
    ) {}

    public function toArray(): array
    {
        return [
            'accountNumber' => $this->accountNumber,
            'accountName' => $this->accountName,
            'bankCode' => $this->bankCode,
        ];
    }
}