<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateACLEntry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:acl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an ACL entry for an user';

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

        $userId = $this->ask('For which user, do you want do create an access?');

        return 0;
    }
}
