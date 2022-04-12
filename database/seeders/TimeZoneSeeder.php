<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $path = database_path('timezone/time_zone.sql');
        $sql = file_get_contents($path);
        \DB::unprepared($sql);
    }
}
