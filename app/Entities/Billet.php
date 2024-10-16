<?php

namespace App\Entities;

class Billet
{
    private string $debtId;
    private string $debtDueDate;
    private float $debtValue;
    private Email $email;
    private string $governmentId;
    private string $name;
    private ?string $billetGeneratedAt = null;
    private ?string $billetSendAt = null;

    public function __construct(string $debtId, string $debtDueDate, float $debtValue, Email $email, string $governmentId, string $name)
    {
        $this->debtId = $debtId;
        $this->debtDueDate = $debtDueDate;
        $this->debtValue = $debtValue;
        $this->email = $email;
        $this->governmentId = $governmentId;
        $this->name = $name;
    }

    public function getDebtId(): string
    {
        return $this->debtId;
    }

    public function getDebtDueDate(): string
    {
        return $this->debtDueDate;
    }

    public function getDebtValue(): float
    {
        return $this->debtValue;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getGovernmentId(): string
    {
        return $this->governmentId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBilletGeneratedAt(): ?string
    {
        return $this->billetGeneratedAt;
    }

    public function setBilletGeneratedAt(?string $billetGeneratedAt): void
    {
        $this->billetGeneratedAt = $billetGeneratedAt;
    }

    public function getBilletSendAt(): ?string
    {
        return $this->billetSendAt;
    }

    public function setBilletSendAt(?string $billetSendAt): void
    {
        $this->billetSendAt = $billetSendAt;
    }
}
