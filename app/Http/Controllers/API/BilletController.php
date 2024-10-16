<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\BilletService;
use App\Services\Facades\BilletFacade;
use Illuminate\Http\Request;

class BilletController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv',
        ]);

        $file = $request->file('file');
        $filepath = BilletFacade::saveBilletsUploadFile(file_get_contents($file));
        BilletFacade::processBilletsUploadFile($filepath);

        return response()->json(['message' => 'Billets successfully upload'], 201);

    }
}
