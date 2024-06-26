<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PurgeUsersCommand extends Command
{
    protected $signature = 'purge:users';

    protected $description = 'Purge all records from the users table';

    public function handle()
    {
        if ($this->confirm('This will delete all records from the users table. Are you sure?')) {
            DB::table('users')->truncate();
            $this->info("Users table purged successfully.");
        } else {
            $this->info('Purge operation cancelled.');
        }
    }
}
