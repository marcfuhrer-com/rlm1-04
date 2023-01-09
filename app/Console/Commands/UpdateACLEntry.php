<?php

namespace App\Console\Commands;

use App\Models\Accesses;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateACLEntry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:acl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an existing ACL entry';

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

        $aclId = $this->ask('Which entry do you want to update?');
        $entry = Accesses::find($aclId);
        if (!$entry) {
            $this->error('No valid ACL id given');

            return 1;
        }

        $operation = $this->choice('Which operations shall he be able to do',
            ['create', 'read', 'update', 'delete', 'subscribe'], null, 2, true);
        $newEntry = new Accesses();
        foreach ($operation as $op) {
            ($newEntry->creates != null) ?: ($op == 'create') ? $newEntry->creates = 1 : $newEntry->creates = 0;
            ($newEntry->reads != null) ?: ($op == 'read') ? $newEntry->reads = 1 : $newEntry->reads = 0;
            ($newEntry->updates != null) ?: ($op == 'update') ? $newEntry->updates = 1 : $newEntry->updates = 0;
            ($newEntry->deletes != null) ?: ($op == 'delete') ? $newEntry->deletes = 1 : $newEntry->deletes = 0;
            ($newEntry->subscribes != null) ?: ($op == 'subscribe') ? $newEntry->subscribes = 1 : $newEntry->subscribes = 0;
        }
        $entry->creates = $newEntry->creates;
        $entry->reads = $newEntry->reads;
        $entry->updates = $newEntry->updates;
        $entry->deletes = $newEntry->deletes;
        $entry->subscribes = $newEntry->subscribes;
        $entry->save();

        $this->info('ACL entry updated');

        return 0;
    }
}
