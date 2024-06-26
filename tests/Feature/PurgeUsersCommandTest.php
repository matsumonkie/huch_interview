<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class PurgeUsersCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_purge_users_command()
    {
        User::factory()->count(5)->create();

        $this->artisan('purge:users')
             ->expectsConfirmation('This will delete all records from the users table. Are you sure?', 'yes');

        $this->assertEquals(0, User::count());
    }
}