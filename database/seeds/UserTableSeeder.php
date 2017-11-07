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
        DB::table('users')->truncate();

        factory(App\Models\User::class, 1)->states('admin')->create();
        factory(App\Models\User::class, 1)->states('teacher')->create();
        factory(\App\Models\User::class, 10)->create();
    }
}
