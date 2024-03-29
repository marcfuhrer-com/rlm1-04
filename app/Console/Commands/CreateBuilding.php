<?php

namespace App\Console\Commands;

use App\Models\Building;
use Illuminate\Console\Command;

class CreateBuilding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:building';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a building';

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
        $buildingName = $this->ask('What is the name of the building?');
        $building = new Building();
        $building->name = $buildingName;
        $building->save();

        $this->info('Building created');

        return 0;
    }
}
