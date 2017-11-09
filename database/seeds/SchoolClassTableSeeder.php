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
        DB::table('school_classes')->truncate();
        factory(\App\Models\SchoolClass::class, 10)->create();
    }
}
