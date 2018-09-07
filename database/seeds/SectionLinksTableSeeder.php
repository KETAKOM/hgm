<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SectionLinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section_links')->insert([
            'hospital_id' => 1,
            'section_id' => 1,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('section_links')->insert([
            'hospital_id' => 1,
            'section_id' => 2,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('section_links')->insert([
            'hospital_id' => 1,
            'section_id' => 3,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('section_links')->insert([
            'hospital_id' => 1,
            'section_id' => 4,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('section_links')->insert([
            'hospital_id' => 2,
            'section_id' => 2,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('section_links')->insert([
            'hospital_id' => 3,
            'section_id' => 3,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('section_links')->insert([
            'hospital_id' => 4,
            'section_id' => 4,
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('section_links')->insert([
            'hospital_id' => 5,
            'section_id' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
