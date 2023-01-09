<?php

namespace App\Console\Commands;

use App\Models\Accesses;
use App\Models\PublisherData;
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
    protected $description = 'Creates an ACL entry for a user';

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
        $user = User::find($userId);
        if ($user == null) {
            $this->error('Wrong user id');

            return 1;
        }

        $this->info('Available Datasets:');
        $availablePublisherDataNames = PublisherData::get()->unique('name');
        foreach ($availablePublisherDataNames as $pubDataName) {
            $this->info($pubDataName->name);
        }

        $dataSet = $this->ask('For which dataset should he get rights?');

        $doesSetExist = PublisherData::get()->where('name', $dataSet)->last();
        if ($doesSetExist == null) {
            $this->error('Does not exists');

            return 1;
        }

        $accesses = Accesses::where('user_id', $userId)->where('publisher_data_name', $dataSet)->first();

        if ($accesses != null) {
            $this->error('ACL entry for user and publisher does already exist. Use update command.');

            return 1;
        }


        $operation = $this->choice('Which operations shall he be able to do',
            ['create', 'read', 'update', 'delete', 'subscribe'], null, 2, true);

        $newEntry = new Accesses();
        $newEntry->user_id = $userId;
        $newEntry->publisher_data_name = $dataSet;

        foreach ($operation as $op) {
            ($newEntry->creates != null) ?: ($op == 'create') ? $newEntry->creates = 1 : $newEntry->creates = 0;
            ($newEntry->reads != null) ?: ($op == 'read') ? $newEntry->reads = 1 : $newEntry->reads = 0;
            ($newEntry->updates != null) ?: ($op == 'update') ? $newEntry->updates = 1 : $newEntry->updates = 0;
            ($newEntry->deletes != null) ?: ($op == 'delete') ? $newEntry->deletes = 1 : $newEntry->deletes = 0;
            ($newEntry->subscribes != null) ?: ($op == 'subscribe') ? $newEntry->subscribes = 1 : $newEntry->subscribes = 0;
        }
        $newEntry->save();

        $this->info('ACL entry created');

        return 0;
    }
}
