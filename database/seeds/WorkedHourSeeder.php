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
            'start' => '2019-9-1 17:00',
            'end' => '2019-9-1 17:30',
            'hours_worked' => 3,
            'user_id' => 1
        ]);
        DB::table('working_hours')->insert([
            'id' => 2,
            'start' => '2019-9-1 17:00',
            'end' => '2019-9-1 17:30',
            'hours_worked' => 0.3,
            'user_id' => 2
        ]);

    }
}
