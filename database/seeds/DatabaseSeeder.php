<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HospitalsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SectionLinksTableSeeder::class);
    }
}
