<?php

namespace App\Console\Commands;

use App\Models\Building;
use App\Models\Floor;
use Illuminate\Console\Command;

class CreateFloor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:floor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a floor for a building';

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
        $buildings = Building::all();
        foreach($buildings as $building) {
            $this->info('Building id ' . $building->id . ' is ' . $building->name);
        }

        $buildingId = $this->ask('For which building do you want to create a floor?');
        $building = Building::find($buildingId);
        if(!$building) {
            $this->error('No valid building id given.');

            return 1;
        }

        $floorName = $this->ask('What is the name of the floor?');
        $floor = new Floor();
        $floor->name = $floorName;
        $floor->building_id = $buildingId;
        $floor->save();

        $this->info('Floor created');

        return 0;
    }
}
