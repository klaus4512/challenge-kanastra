<?php

namespace App\Services\Interfaces;

use App\Entities\Billet;

interface BilletMailService
{
    public function send(Billet $billet, array $attachments): void;
}
