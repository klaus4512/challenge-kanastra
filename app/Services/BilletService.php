<?php

namespace App\Services;

use App\Entities\Billet;
use App\Jobs\GenerateBilletPDF;
use App\Jobs\ProcessBilletFile;
use App\Repositories\BilletFileRepository;

class BilletService
{
    public function __construct(
        private readonly BilletFileRepository $billetFileRepository,
    )
    {}

    public function saveBilletsUploadFile($file):string
    {
        return $this->billetFileRepository->saveFile($file);
    }

    public function processBilletsUploadFile(string $filePath):void
    {
        ProcessBilletFile::dispatch($filePath);
    }

    public function generateAndSendBilletPDF(Billet $billet):void
    {
        GenerateBilletPDF::dispatch($billet);
    }
}
