<?php

namespace Tests\Unit;

use App\Jobs\ProcessBilletFile;
use App\Repositories\BilletFileLocalRepository;
use App\Repositories\BilletFileRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProcessBilletFileTest extends TestCase
{
    use RefreshDatabase;

    private BilletFileRepository $billetFileRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->billetFileRepository = app(BilletFileLocalRepository::class);
    }

    public function test_job_processes_billet_file(): void
    {
        Queue::fake();

        // Simulate the existence of a CSV file to be processed
        $csvContent = "debt_id,debt_due_date,debt_value,email,government_id,name\n" .
            "2db8a009-711f-43dd-a3a3-9dcd13b6c1ad,2021-10-10,100.00,teste@gmail.com,00000000000,Afonso da Silva";

        $filePath = $this->billetFileRepository->saveFile($csvContent);

        $job = new ProcessBilletFile($filePath);

        // Espera que não tenha nenhuma excessão no processamento
        try {
            $job->handle();
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->fail('Job threw an exception: ' . $e->getMessage());
        }
    }
}
