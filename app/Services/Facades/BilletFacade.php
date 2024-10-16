<?php
namespace App\Services\Facades;

use App\Services\BilletService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string saveBilletsUploadFile($file)
 * @method static void processBilletsUploadFile(string $filePath)
 * @method static void generateAndSendBilletPDF($billet)
 */

class BilletFacade extends Facade {
    protected static function getFacadeAccessor(): string
    {
        return BilletService::class;
    }
}
