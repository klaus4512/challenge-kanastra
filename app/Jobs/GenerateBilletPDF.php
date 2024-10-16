<?php

namespace App\Jobs;

use App\Entities\Billet;
use App\Entities\Email;
use App\Repositories\BilletFileRepository;
use App\Repositories\BilletRepository;
use App\Services\Interfaces\BilletPDFGeneratorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateBilletPDF implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Billet  $billet,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(BilletRepository $billetRepository, BilletPDFGeneratorService $billetPDFGeneratorService): void
    {
        //
        try{
            $this->billet = $billetRepository->find($this->billet->getDebtId());
            if ($this->billet->getBilletGeneratedAt() !== null){
                Log::build(
                    [
                        'driver' => 'single',
                        'path' => storage_path('logs/billetPDF.log'),
                    ]
                )->critical('Billet already generated');
                return;
            }
            $this->billet->setBilletGeneratedAt(now());
            $billetRepository->update($this->billet);
            $billetPDF = $billetPDFGeneratorService->generatePDF($this->billet);
            SendBilletMail::dispatch($this->billet, [$billetPDF]);
        }catch (\Exception $e){
            Log::build(
                [
                    'driver' => 'single',
                    'path' => storage_path('logs/billetPDF.log'),
                ]
            )->critical($e);
            $this->billet->setBilletGeneratedAt(null);
            $billetRepository->update($this->billet);
        }

    }
}
