<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class registerUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $name = $this->ask('What is the users name?');
        $mail = $this->ask('What is the users mail?');
        $password = $this->secret('What is the password?');
        $role = $this->ask('What is the users role?');

        User::create([
            'name' => $name,
            'email' => $mail,
            'password' => Hash::make($password)
        ]);

        $this->info('User created!');

        return 0;
    }
}
