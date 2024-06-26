<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ImportUsersCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_users_command()
    {
        $csvFilePath = storage_path('app/public/users.csv');
        Storage::disk('public')->put('users.csv', "huonghuong,Irvin,Murphy,1982-10-19,estell@quitzon.test,R35qQwu7zv");

        Artisan::call('import:users', [
            'file' => $csvFilePath,
        ]);

        $this->assertEquals(1, User::count());
        $this->assertTrue(User::where('email', 'estell@quitzon.test')->exists());
    }
}