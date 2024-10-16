<?php

namespace App\Repositories;

use App\Entities\Billet;

interface BilletRepository
{
    public function create(Billet $billet): void;
    public function update(Billet $billet): void;

    public function find(string $debtId): ?Billet;

    public function findPending():array;
}
