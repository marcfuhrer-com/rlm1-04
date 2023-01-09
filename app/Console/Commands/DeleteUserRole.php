<?php

namespace App\Console\Commands;

use App\Models\HasRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class DeleteUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:userrole';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a role of an user';

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

        $userId = $this->ask('For which user u want to delete a role?');
        $user = User::find($userId);
        if (!$user) {
            $this->info('No valid user id given');

            return 0;
        }

        $this->info('Current User roles:');
        $roles = HasRole::all()->where('user_id', $userId);
        foreach ($roles as $role) {
            $roleName = Role::find($role->role_id);
            $this->info('Id ' . $role->id . ' is role ' . $roleName->name);
        }

        $roleToDelete = $this->ask('Which role shall be deleted?');
        $role = HasRole::find($roleToDelete);
        if (!$role) {
            $this->info('No valid role id given');

            return 0;
        }
        $role->delete();
        $this->info('Role deleted.');

        return 0;
    }
}
