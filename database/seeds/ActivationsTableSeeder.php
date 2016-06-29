<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ActivationsTableSeeder extends Seeder
{
    public function run()
    {
         DB::table('activations')->insert([
            'user_id' => '1',
            'completed' => '1'
        ]);

        DB::table('activations')->insert([
            'user_id' => '2',
            'completed' => '1'
        ]);
    }
}
