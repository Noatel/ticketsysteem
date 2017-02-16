<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name' => 'PersC',
            ],
            [
                'name' => 'McDonald',
            ],
            [
                'name' => 'KFC',
            ],
            [
                'name' => 'Subway',
            ],
        ]);
    }
}
