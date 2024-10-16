<?php

namespace Tests\Unit;

use App\Entities\Billet;
use App\Entities\Email;
use App\Jobs\CreateNewBillet;
use App\Repositories\BilletRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class CreateNewBilletTest extends TestCase
{
    use RefreshDatabase;

    private Billet $billet;

    public function setUp(): void
    {
        parent::setUp();
        $this->billet = new Billet(
            '2db8a009-711f-43dd-a3a3-9dcd13b6c1ad',
            '2021-10-10 00:00:00',
            100.00,
            new Email('teste@gmail.com'),
            '00000000000',
            'Afonso da Silva',
        );
    }

    public function test_job_creates_new_billet(): void
    {
        Queue::fake();

        $billetRepository = app(BilletRepository::class);

        $job = new CreateNewBillet($this->billet);
        $job->handle($billetRepository);

        $billet = $billetRepository->find($this->billet->getDebtId());

        $this->assertNotNull($billet);
        $this->assertEquals($this->billet->getDebtId(), $billet->getDebtId());
    }
}
