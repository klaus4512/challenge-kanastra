<?php

namespace App\Jobs;

use App\Entities\Billet;
use App\Entities\Email;
use App\Repositories\BilletFileRepository;
use App\Repositories\BilletRepository;
use App\Services\Interfaces\BilletMailService;
use App\Services\Interfaces\BilletPDFGeneratorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendBilletMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Billet  $billet,
        public readonly array $attachments
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(BilletRepository $billetRepository, BilletMailService $billetMailService): void
    {
        //
        try{
            $this->billet = $billetRepository->find($this->billet->getDebtId());
            if ($this->billet->getBilletSendAt() !== null){
                Log::build(
                    [
                        'driver' => 'single',
                        'path' => storage_path('logs/mail.log'),
                    ]
                )->critical('Billet already sent');
                return;
            }
            $this->billet->setBilletSendAt(now());
            $billetRepository->update($this->billet);
            $billetMailService->send($this->billet, $this->attachments);
        }catch (\Exception $e){
            Log::build(
                [
                    'driver' => 'single',
                    'path' => storage_path('logs/mail.log'),
                ]
            )->critical($e);
            $this->billet->setBilletSendAt(null);
            $billetRepository->update($this->billet);
        }

    }
}
