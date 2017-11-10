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
         $this->call(AdminTableSeeder::class);
         $this->call(TeacherTableSeeder::class);
         $this->call(StudentTableSeeder::class);
         $this->call(SubjectTableSeeder::class);
         $this->call(SchoolClassTableSeeder::class);
    }
}
