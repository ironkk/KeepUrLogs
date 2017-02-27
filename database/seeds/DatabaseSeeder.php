<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'     => 'admin',
                'email'    => 'test@test.com',
                'password' => bcrypt('admin'),
                'level'    => 7,
            ]
        );
    }
}
