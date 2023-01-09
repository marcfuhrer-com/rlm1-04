<?php

namespace App\Console\Commands;

use App\Models\Building;
use Illuminate\Console\Command;

class DeleteBuilding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:building';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a building';

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
        foreach ($buildings as $building) {
            $this->info('Id ' . $building->id . ' is ' . $building->name);
        }

        $buildingId = $this->ask('Which building do u want to delete?');
        $building = Building::find($buildingId);
        if (!$building) {
            $this->error('No valid building id given');

            return 1;
        }

        $building->delete();

        $this->info('Building deleted.');

        return 0;
    }
}
