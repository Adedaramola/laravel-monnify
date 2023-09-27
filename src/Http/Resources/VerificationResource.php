<?php

declare(strict_types=1);

namespace Adedaramola\Monnify\Http\Resources;

use Adedaramola\Monnify\DataObjects\BankAccount;
use Adedaramola\Monnify\Enums\Method;

class VerificationResource extends MonnifyResource
{
    public function validateBankAccount(string $accountNumber, string $bankCode): BankAccount
    {
        $response = $this->client->send(
            method: Method::GET,
            uri: '/api/v1/disbursements/account/validate',
            options: [
                'accountNumber' => $accountNumber,
                'bankCode' => $bankCode,
            ],
        );

        $bankAccount = $response->json('responseBody');

        return new BankAccount(
            accountNumber: $bankAccount->accountNumber,
            accountName: $bankAccount->accountName,
            bankCode: $bankAccount->bankCode,
        );
    }
}