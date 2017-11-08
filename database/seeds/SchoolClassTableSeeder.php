<?php

use Illuminate\Database\Seeder;

class SchoolClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\SchoolClass::class, 20)->create();
    }
}
