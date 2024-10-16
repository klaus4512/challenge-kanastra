<?php

namespace App\Repositories;

interface BilletFileRepository
{
    public function saveFile($file):string;
}
