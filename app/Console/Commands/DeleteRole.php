<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;

class DeleteRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a role';

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
        $roles = Role::all();
        foreach ($roles as $role) {
            $this->info('Id ' . $role->id . ' is ' . $role->name);
        }

        $roleId = $this->ask('Which role do u want to delete?');
        $role = Role::find($roleId);
        if (!$role) {
            $this->error('No valid role id given');

            return 1;
        }

        $role->delete();

        $this->info('Role deleted.');

        return 0;
    }
}
