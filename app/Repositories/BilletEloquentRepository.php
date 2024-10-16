<?php

namespace App\Repositories;

use App\Entities\Billet;

class BilletEloquentRepository implements BilletRepository
{

    public function create(Billet $billet): void
    {
        $billetModel = new \App\Models\Billet();
        $billetModel->fill([
            'debt_id' => $billet->getDebtId(),
            'debt_due_date' => $billet->getDebtDueDate(),
            'debt_value' => $billet->getDebtValue(),
            'email' => $billet->getEmail()->getEmail(),
            'government_id' => $billet->getGovernmentId(),
            'name' => $billet->getName(),
            'billet_generated_at' => $billet->getBilletGeneratedAt(),
            'billet_send_at' => $billet->getBilletSendAt(),
        ]);
        $billetModel->save();
    }

    public function update(Billet $billet): void
    {
        \App\Models\Billet::query()->where('debt_id', $billet->getDebtId())
            ->update([
                'debt_id' => $billet->getDebtId(),
                'debt_due_date' => $billet->getDebtDueDate(),
                'debt_value' => $billet->getDebtValue(),
                'email' => $billet->getEmail()->getEmail(),
                'government_id' => $billet->getGovernmentId(),
                'name' => $billet->getName(),
                'billet_generated_at' => $billet->getBilletGeneratedAt(),
                'billet_send_at' => $billet->getBilletSendAt(),
            ]);
    }

    public function find(string $debtId): ?Billet
    {
        $billetModel = \App\Models\Billet::query()->where('debt_id', $debtId)->first();
        if ($billetModel === null) {
            return null;
        }

        $billet =  new Billet(
            $billetModel->debt_id,
            $billetModel->debt_due_date,
            $billetModel->debt_value,
            new \App\Entities\Email($billetModel->email),
            $billetModel->government_id,
            $billetModel->name,
        );

        $billet->setBilletGeneratedAt($billetModel->billet_generated_at);
        $billet->setBilletSendAt($billetModel->billet_send_at);
        return $billet;
    }

    public function findPending(): array
    {
        $billetModels = \App\Models\Billet::query()
            ->whereNull('billet_generated_at')
            ->get();

        $billets = [];
        foreach ($billetModels as $billetModel) {
            $billet =  new Billet(
                $billetModel->debt_id,
                $billetModel->debt_due_date,
                $billetModel->debt_value,
                new \App\Entities\Email($billetModel->email),
                $billetModel->government_id,
                $billetModel->name,
            );

            $billet->setBilletGeneratedAt($billetModel->billet_generated_at);
            $billet->setBilletSendAt($billetModel->billet_send_at);
            $billets[] = $billet;
        }

        return $billets;
    }
}
