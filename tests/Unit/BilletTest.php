<?php

namespace Tests\Unit;

use App\Entities\Billet;
use App\Entities\Email;
use PHPUnit\Framework\TestCase;

class BilletTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_create_billet(): void
    {
        $billet = new Billet(
            '2db8a009-711f-43dd-a3a3-9dcd13b6c1ad',
            '2021-10-10',
            100.00,
            new Email('teste@gmail.com'),
            '00000000000',
            'Afonso da Silva',
        );

        $this->assertEquals('2db8a009-711f-43dd-a3a3-9dcd13b6c1ad', $billet->getDebtId());
        $this->assertEquals('2021-10-10', $billet->getDebtDueDate());
        $this->assertEquals(100.00, $billet->getDebtValue());
        $this->assertEquals(new Email('teste@gmail.com'), $billet->getEmail());
        $this->assertEquals('00000000000', $billet->getGovernmentId());
        $this->assertEquals('Afonso da Silva', $billet->getName());
    }

    public function test_set_billet_generated_at(): void
    {
        $billet = new Billet(
            '2db8a009-711f-43dd-a3a3-9dcd13b6c1ad',
            '2021-10-10',
            100.00,
            new Email('teste@gmail.com'),
            '00000000000',
            'Afonso da Silva',
        );

        $dateTime = now();
        $billet->setBilletGeneratedAt($dateTime);

        $this->assertEquals($dateTime, $billet->getBilletGeneratedAt());
    }

    public function test_set_billet_send_at(): void
    {
        $billet = new Billet(
            '2db8a009-711f-43dd-a3a3-9dcd13b6c1ad',
            '2021-10-10',
            100.00,
            new Email('teste@gmail.com'),
            '00000000000',
            'Afonso da Silva',
        );

        $dateTime = now();
        $billet->setBilletSendAt($dateTime);

        $this->assertEquals($dateTime, $billet->getBilletSendAt());
    }
}
