<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'noah@persc.nl',
                'password' => bcrypt('noah'),
                'name' => 'noah'
            ]
        ]);
    }
}
