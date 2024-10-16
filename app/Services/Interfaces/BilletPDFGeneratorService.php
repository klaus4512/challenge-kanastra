<?php

namespace App\Services\Interfaces;

use App\Entities\Billet;

interface BilletPDFGeneratorService
{
    public function generatePDF(Billet $billet): string;
}
