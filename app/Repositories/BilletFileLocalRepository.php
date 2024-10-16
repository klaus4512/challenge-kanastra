<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BilletFileLocalRepository implements BilletFileRepository
{

    public function saveFile($file): string
    {
        $path = 'billet/'.Str::random(40).'.csv';
        Storage::disk('local')->put($path, $file);
        return Storage::disk('local')->path($path);
    }
}
