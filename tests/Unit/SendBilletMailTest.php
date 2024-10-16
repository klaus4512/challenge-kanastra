<?php

namespace Tests\Unit\Jobs;

use App\Jobs\SendBilletMail;
use App\Entities\Billet;
use App\Repositories\BilletRepository;
use App\Services\Interfaces\BilletMailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Mockery;

class SendBilletMailTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_billet_mail_job()
    {

        $billet = Mockery::mock(Billet::class);
        $billetRepository = Mockery::mock(BilletRepository::class);
        $billetMailService = Mockery::mock(BilletMailService::class);

        $billet->shouldReceive('getDebtId')->andReturn(1);
        $billet->shouldReceive('getBilletSendAt')->andReturn(null);
        $billet->shouldReceive('setBilletSendAt')->once();
        $billetRepository->shouldReceive('find')->with(1)->andReturn($billet);
        $billetRepository->shouldReceive('update')->once();
        $billetMailService->shouldReceive('send')->once()->with($billet, ['attachment1', 'attachment2']);

        Log::shouldReceive('build')->andReturnSelf();
        Log::shouldReceive('critical')->never();

        Queue::fake();

        $job = new SendBilletMail($billet, ['attachment1', 'attachment2']);
        $job->handle($billetRepository, $billetMailService);

        Queue::assertNothingPushed();
    }
}
