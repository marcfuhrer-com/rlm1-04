<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class deleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user';

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
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $this->info('Id ' . $user->id . ' is ' . $user->name);
        }

        $userId = $this->ask('Which user u want to delete?');
        $user = User::find($userId);
        if (!$user) {
            $this->info('No valid user id given');

            return 0;
        }

        $user->delete();

        $this->info('User deleted.');

        return 0;
    }
}
