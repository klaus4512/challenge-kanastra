<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BilletControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_billets_upload_file(): void
    {
        Storage::fake('local');

        $csvContent = "debt_id,debt_due_date,debt_value,email,government_id,name\n" .
            "2db8a009-711f-43dd-a3a3-9dcd13b6c1ad,2021-10-10,100.00,teste@gmail.com,00000000000,Afonso da Silva";
        $file = UploadedFile::fake()->createWithContent('billets.csv', $csvContent);

        $response = $this->postJson('/api/billet', [
            'file' => $file,
        ]);

        $response->assertStatus(201);
    }

    public function test_save_billets_upload_invalid_file_format(): void
    {
        Storage::fake('local');

        $txtContent = "This is a text file, not a CSV.";
        $file = UploadedFile::fake()->createWithContent('billets.txt', $txtContent);

        $response = $this->postJson('/api/billet', [
            'file' => $file,
        ]);

        $response->assertStatus(422);
    }
}
