<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Study;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Study::all()
            ->each(function($study, $key) {
                $study->modules()->saveMany(Module::factory(7)->make());
            });
    }
}
