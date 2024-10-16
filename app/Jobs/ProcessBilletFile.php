<?php

namespace App\Jobs;

use App\Entities\Billet;
use App\Entities\Email;
use App\Repositories\BilletRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessBilletFile implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string  $filePath,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $handle = fopen($this->filePath, 'rb');
        if(!$handle){
            Log::build(
                [
                    'driver' => 'single',
                    'path' => storage_path('logs/billet_file_processor.log'),
                ]
            )->alert('Não foi possível processar o arquivo: ' . $this->filePath);
        }

        fgetcsv($handle, null, ',');
        while(false !== ($data = fgetcsv($handle, null, ','))){
            try{
                $billet = new Billet(
                    $data[5],
                    $data[4],
                    $data[3],
                    new Email($data[2]),
                    $data[1],
                    $data[0]
                );
                CreateNewBillet::dispatch($billet);
            }catch (\Exception $e){
                Log::build(
                    [
                        'driver' => 'single',
                        'path' => storage_path('logs/billet_file_processor.log'),
                    ]
                )->alert($e);
            }
        }
        fclose($handle);
    }
}
