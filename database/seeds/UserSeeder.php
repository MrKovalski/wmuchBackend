<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'filip',
            'email' => 'filip@filipilc.com',
            'password' => bcrypt('secret'),
            'working_status' => true,
            'hour_rate' => 2000.00,
            'role_id' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'felipo',
            'email' => 'filip@filipilc.info',
            'password' => bcrypt('secret'),
            'working_status' => true,
            'hour_rate' => 200.00,
            'role_id' => 2,
        ]);
    }
}
