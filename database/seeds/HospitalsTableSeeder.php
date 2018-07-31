<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert([
            'name' => '都庁の総合大学病院',
            'address' => '東京都新宿区西新宿2丁目8-1',
            'section' => '内科',
            'publish_flg' => '0',
            'publish_start' => '2018-07-01',
            'publish_last' => '2019-07-01',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('hospitals')->insert([
            'name' => '新宿区役所の病院',
            'address' => '東京都新宿区歌舞伎町1丁目4-1',
            'section' => '外科',
            'publish_flg' => '0',
            'publish_start' => '2019-09-01',
            'publish_last' => '2020-09-01',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('hospitals')->insert([
            'name' => '渋谷区役所の病院',
            'address' => '東京都渋谷区渋谷1-18-21',
            'section' => '小児科',
            'publish_flg' => '0',
            'publish_start' => '2018-08-01',
            'publish_last' => '2019-08-01',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('hospitals')->insert([
            'name' => '千代田区役所の病院',
            'address' => '東京都千代田区九段南1丁目2−1',
            'section' => '外科',
            'publish_flg' => '1',
            'publish_start' => '2018-07-01',
            'publish_last' => '2019-07-01',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('hospitals')->insert([
            'name' => '渋谷区役所の初台病院',
            'address' => '東京都渋谷区初台1丁目33−10',
            'section' => '小児科',
            'publish_flg' => '0',
            'publish_start' => '2018-07-01',
            'publish_last' => '2019-07-01',
            'created_at' => Carbon::now(),
        ]);
    }
}
