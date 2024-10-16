<?php

namespace App\Jobs;

use App\Entities\Billet;
use App\Entities\Email;
use App\Repositories\BilletRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class CreateNewBillet implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Billet  $billet,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(BilletRepository $billetRepository): void
    {
        //
        try{
            $billetRepository->create($this->billet);
        }catch (\Exception $e){
            Log::build(
                [
                    'driver' => 'single',
                    'path' => storage_path('logs/billet_creation.log'),
                ]
            )->alert($e);
        }

    }
}
