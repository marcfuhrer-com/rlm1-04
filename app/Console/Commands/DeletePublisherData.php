<?php

namespace App\Console\Commands;

use App\Models\PublisherData;
use Illuminate\Console\Command;

class DeletePublisherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:publisherdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes publisher_data';

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
        $this->info('Available Datasets:');
        $availablePublisherDataNames = PublisherData::get()->unique('name');
        foreach ($availablePublisherDataNames as $pubDataName) {
            $this->info($pubDataName->name);
        }

        $dataToClear = $this->ask('For which set do you want to clear all data?');

        $doesSetExist = PublisherData::get()->where('name', $dataToClear)->last();
        if ($doesSetExist == null) {
            $this->error('No data exists for given name');

            return 1;
        }
        $pubDataToDelete = PublisherData::where('name', $dataToClear)->get();
        foreach ($pubDataToDelete as $pubData) {
            $pubData->delete();
        }

        $this->info('Data cleared for name ' . $dataToClear);

        return 0;
    }
}
