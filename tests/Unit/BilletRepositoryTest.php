<?php


use App\Entities\Billet;
use App\Entities\Email;
use App\Repositories\BilletEloquentRepository;
use App\Repositories\BilletRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BilletRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private Billet $billet;
    private BilletRepository $billetRepository;

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
        $this->billetRepository = new BilletEloquentRepository();

    }

    /**
     * A basic test example.
     */
    public function test_create_billet(): void
    {
        $this->billetRepository->create($this->billet);
        $billet = $this->billetRepository->find($this->billet->getDebtId());
        $this->assertEquals($this->billet, $billet);
    }

    public function test_update_billet(): void
    {
        $dateTime = now();
        $this->billet->setBilletSendAt($dateTime);
        $this->billetRepository->create($this->billet);
        $this->billetRepository->update($this->billet);
        $billet = $this->billetRepository->find($this->billet->getDebtId());
        $this->assertEquals($this->billet, $billet);
    }
}
