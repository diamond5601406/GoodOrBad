<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'goodOrbad' => '1',
            'level' => '5',
            'title' => '早起き',
            'content' => '7時起床徹底',
        ]);
    }
}
