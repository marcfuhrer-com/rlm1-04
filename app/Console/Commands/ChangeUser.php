<?php

namespace App\Console\Commands;

use App\Models\HasRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ChangeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change an existing user';

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
            $this->info('Id ' . $user->id . ' is role ' . $user->name);
        }

        $userId = $this->ask('Which user u want to change?');
        $user = User::find($userId);
        if (!$user) {
            $this->info('No valid user id given');

            return 0;
        }

        $changeName = $this->ask('You want to change his name? y/n');
        if ($changeName == 'y' or $changeName == 'yes') {
            $newUserName = $this->ask("What's his new name?");
        }
        $changeMail = $this->ask('You want to change his mail? y/n');
        if ($changeMail == 'y' or $changeMail == 'yes') {
            $newMail = $this->ask("What's his new mail?");
        }
        $changePassword = $this->ask('You want to change his password? y/n');
        if ($changePassword == 'y' or $changePassword == 'yes') {
            $newPassword = $this->secret("What's his new password?");
        }
        $changeDuration = $this->ask('You want to change his duration? y/n');
        if ($changeDuration == 'y' or $changeDuration == 'yes') {
            $newDuration = $this->ask("What's his new duration?");
        }

        (!isset($newUserName)) ?: $user->name = $newUserName;
        (!isset($newMail)) ?: $user->email = $newMail;
        (!isset($newPassword)) ?: $user->password = $newPassword;
        (!isset($newDuration)) ?: $user->default_duration = $newDuration;
        $user->save();

        $changeRoles = $this->ask('You want to change or add his roles? y/n');
        if ($changeRoles == 'y' or $changeRoles == 'yes') {

            $this->info('Existing roles:');

            $roles = Role::all();
            foreach ($roles as $role) {
                $this->info('Id ' . $role->id . ' is role ' . $role->name);
            }

            $this->info(PHP_EOL . 'Current User roles:');
            $roles = HasRole::all()->where('user_id', $userId);
            foreach ($roles as $role) {
                $roleName = Role::find($role->role_id);
                $this->info('Id ' . $role->id . ' is role ' . $roleName->name);
            }

            $changeRole = $this->ask('You want to change one of his roles? y/n');
            if ($changeRole == 'y' or $changeRole == 'yes') {

                $whichRole = $this->ask('Which role u want to change? id');
                $role = HasRole::find($whichRole);
                if (!$role) {
                    $this->info('No valid role id given');

                    return 0;
                }

                $whichRole = $this->ask('Which role should it be? id');
                if (!$whichRole) {
                    $this->info('No valid role id given');

                    return 0;
                }

                $role->role_id = $whichRole;
                $role->save();
            }

            $addRole = $this->ask('You want to add a role? y/n');
            if ($addRole == 'y' or $addRole == 'yes') {
                $newRole = $this->ask('What is the users role?');
                $roleToCreate = new HasRole();
                $roleToCreate->role_id = $newRole;
                $roleToCreate->user_id = $userId;
                $roleToCreate->save();
            }

        }

        $this->info('User adjusted!');
        return 0;
    }
}
