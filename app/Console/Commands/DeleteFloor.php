<?php

namespace App\Console\Commands;

use App\Models\Building;
use App\Models\Floor;
use Illuminate\Console\Command;

class DeleteFloor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:floor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an existing floor';

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
        $floors = Floor::all();
        foreach ($floors as $floor) {
            $building = Building::find($floor->building_id);
            $this->info('Id ' . $floor->id . ' is ' . $floor->name . ' for building: ' . $building->name);
        }

        $floorId = $this->ask('Which floor do u want to delete?');
        $floor = Floor::find($floorId);
        if (!$floor) {
            $this->error('No valid floor id given');

            return 1;
        }

        $floor->delete();

        $this->info('Floor deleted.');

        return 0;
    }
}
