<?php

namespace Tests\Unit\Jobs;

use App\Jobs\GenerateBilletPDF;
use App\Entities\Billet;
use App\Jobs\SendBilletMail;
use App\Repositories\BilletRepository;
use App\Services\Interfaces\BilletPDFGeneratorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Mockery;

class GenerateBilletPDFTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_billet_pdf_job()
    {

        $billet = Mockery::mock(Billet::class);
        $billetRepository = Mockery::mock(BilletRepository::class);
        $billetPDFGeneratorService = Mockery::mock(BilletPDFGeneratorService::class);

        $billet->shouldReceive('getDebtId')->andReturn(1);
        $billet->shouldReceive('getBilletGeneratedAt')->andReturn(null);
        $billet->shouldReceive('setBilletGeneratedAt')->once();
        $billetRepository->shouldReceive('find')->with(1)->andReturn($billet);
        $billetRepository->shouldReceive('update')->once();
        $billetPDFGeneratorService->shouldReceive('generatePDF')->once()->andReturn('pdf_content');

        Log::shouldReceive('build')->andReturnSelf();
        Log::shouldReceive('critical')->never();

        Queue::fake();

        $job = new GenerateBilletPDF($billet);
        $job->handle($billetRepository, $billetPDFGeneratorService);


        Queue::assertPushed(SendBilletMail::class, function ($job) use ($billet) {
            return $job->billet === $billet && $job->attachments[0] === 'pdf_content';
        });
    }
}
