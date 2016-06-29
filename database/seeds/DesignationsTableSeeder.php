<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class DesignationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('designations')->insert([
            'name' => 'Web Developer',
            'slug' => 'web-developer'
        ]);

         DB::table('designations')->insert([
            'name' => 'IT Manager',
            'slug' => 'it-manager'
        ]);
    }
}
