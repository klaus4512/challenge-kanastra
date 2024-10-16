<?php

namespace App\Console\Commands;

use App\Repositories\BilletRepository;
use App\Services\Facades\BilletFacade;
use Illuminate\Console\Command;

class SendBillets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-billets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera os boletos e enviar por email para os clientes';

    /**
     * Execute the console command.
     */
    public function handle(BilletRepository $billetRepository): void
    {
        //
        $billets = $billetRepository->findPending();
        foreach ($billets as $billet){
            BilletFacade::generateAndSendBilletPDF($billet);
        }
    }
}
