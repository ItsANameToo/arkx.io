<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:create-user {email} {password} {--role=admin}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::create([
            'email'     => $this->argument('email'),
            'password'  => Hash::make($this->argument('password')),
            'api_token' => bin2hex(openssl_random_pseudo_bytes(32)),
        ])->assignRole($this->option('role'));
    }
}
