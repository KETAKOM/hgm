<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'section_name' => '内科',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('sections')->insert([
            'section_name' => '外科',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('sections')->insert([
            'section_name' => '小児科',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('sections')->insert([
            'section_name' => '検診',
            'created_at' => Carbon::now(),
        ]);
    }
}
