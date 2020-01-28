<?php

use Illuminate\Database\Seeder;

class WorkedHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('working_hours')->insert([
            'id' => 1,
            'start' => now(),
            'end' => now(),
            'hours_worked' => 3,
            'user_id' => 1
        ]);
        DB::table('working_hours')->insert([
            'id' => 2,
            'start' => now(),
            'end' => now(),
            'hours_worked' => 3,
            'user_id' => 2
        ]);

    }
}
