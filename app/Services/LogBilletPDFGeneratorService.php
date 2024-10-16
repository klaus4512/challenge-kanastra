<?php

namespace App\Services;

use App\Entities\Billet;
use App\Services\Interfaces\BilletPDFGeneratorService;
use Illuminate\Support\Facades\Log;

class LogBilletPDFGeneratorService implements BilletPDFGeneratorService
{

    public function generatePDF(Billet $billet): string
    {
        Log::build(
            [
                'driver' => 'single',
                'path' => storage_path('logs/billetPDF.log'),
            ]
        )->log('info', 'Generating PDF for billet', [
            'debt_id' => $billet->getDebtId(),
            'debt_due_date' => $billet->getDebtDueDate(),
            'debt_value' => $billet->getDebtValue(),
            'email' => $billet->getEmail()->getEmail(),
            'government_id' => $billet->getGovernmentId(),
            'name' => $billet->getName(),
        ]);

        return '/example/path/to/billet.pdf';
    }
}
