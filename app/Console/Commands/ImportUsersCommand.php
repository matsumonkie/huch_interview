<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ImportUsersCommand extends Command
{
    protected $signature = 'import:users {file}';

    protected $description = 'Import users from a CSV file';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        $csvData = array_map('str_getcsv', file($file));

        $bar = $this->output->createProgressBar(count($csvData));

        foreach ($csvData as $row) {
            $userData = [
                'username' => $row[0],
                'firstname' => $row[1],
                'lastname' => $row[2],
                'dob' => $row[3],
                'email' => $row[4],
                'password' => Hash::make($row[5]),
            ];

            // We can batch insert if we want to improve performance
            // but hashing the password is really time consuming and will
            // be our main threshold if we want to speed up things
            $user = User::create($userData);
            event(new \App\Events\UserCreated($user));

            $bar->advance();
        }

        $bar->finish();

        $this->info("\nUsers imported successfully from {$file}");
        return 0;
    }
}