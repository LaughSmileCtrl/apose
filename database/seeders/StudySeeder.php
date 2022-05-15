<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Study;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classroom::all()
            ->each(function ($classroom, $key) {
                $classroom->studies()->saveMany(Study::factory(3)->make());
            });



    }
}
