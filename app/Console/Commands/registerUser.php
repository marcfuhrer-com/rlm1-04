<?php

namespace App\Console\Commands;

use App\Models\HasRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

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
        $defaultDuration = $this->ask('What is his duration?');

        $roles = Role::all();
        foreach ($roles as $role) {
            $this->info('Id ' . $role->id . ' is role ' . $role->name);
        }


        $userRole = $this->ask('What is the users role?');

        $user = new User();
        $user->name = $name;
        $user->email = $mail;
        $user->password = Hash::make($password);
        (!is_int($defaultDuration)) ?: $user->default_duration = $defaultDuration;
        $user->save();

        $roleToCreate = new HasRole();
        $roleToCreate->role_id = $userRole;
        $roleToCreate->user_id = $user->id;
        $roleToCreate->save();

        $this->info('User created!');

        return 0;
    }
}
