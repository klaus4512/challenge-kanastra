<?php

namespace Tests\Unit;

use App\Repositories\BilletFileLocalRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class BilletFileRepositoryTest extends TestCase
{
    public function test_save_file(): void
    {
        Storage::fake('local');

        $repository = new BilletFileLocalRepository();

        // Simulate the content of a CSV file
        $csvContent = "debt_id,debt_due_date,debt_value,email,government_id,name\n" .
            "2db8a009-711f-43dd-a3a3-9dcd13b6c1ad,2021-10-10,100.00,teste@gmail.com,00000000000,Afonso da Silva";

        // Save the file using the repository
        $filePath = $repository->saveFile($csvContent);

        // Assert that the content of the file is correct
        $this->assertEquals($csvContent, file_get_contents($filePath));
    }
}
