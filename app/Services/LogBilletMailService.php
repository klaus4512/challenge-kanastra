<?php

namespace App\Services;

use App\Entities\Billet;
use App\Services\Interfaces\BilletMailService;
use Illuminate\Support\Facades\Log;

class LogBilletMailService implements BilletMailService
{

    public function send(Billet $billet, array $attachments): void
    {
        Log::build(
            [
                'driver' => 'single',
                'path' => storage_path('logs/mail.log'),
            ]
        )->log('info', 'Sending billet mail', [
            'debt_id' => $billet->getDebtId(),
            'debt_due_date' => $billet->getDebtDueDate(),
            'debt_value' => $billet->getDebtValue(),
            'email' => $billet->getEmail()->getEmail(),
            'government_id' => $billet->getGovernmentId(),
            'name' => $billet->getName(),
            'attachments' => $attachments,
        ]);
    }
}
