<?php

namespace App\Console\Commands;

use App\Models\Accesses;
use App\Models\User;
use Illuminate\Console\Command;

class DeleteACLEntry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:acl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes an ACL entry';

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
        $accesses = Accesses::all();
        foreach ($accesses as $aclEntry) {
            $user = User::find($aclEntry->user_id);
            $this->info('Id ' . $aclEntry->id . ' is ' . $aclEntry->publisher_data_name . ' for user ' . $user->name);
        }

        $aclId = $this->ask('Which entry do u want to delete?');
        $entry = Accesses::find($aclId);
        if (!$entry) {
            $this->error('No valid ACL id given');

            return 1;
        }

        $entry->delete();
        $this->info('ACL deleted.');

        return 0;
    }
}
