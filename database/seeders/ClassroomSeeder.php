<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = School::where('id', '<>', 0)->first();

        $school->classrooms()->createMany([
            ['name' => '10 Mipa 5'],
            ['name' => '11 Mipa 4'],
            ['name' => '12 Mipa 3'],
        ]);
    }
}
