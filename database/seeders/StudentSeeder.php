<?php

namespace Database\Seeders;
use App\Models\MbaApplication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MbaApplication::create([
            'full_name' => 'test2',
            'email' => 'test2@gmail.com',
            'date_of_birth' => '2000-09-08',
            'age' => 20,
            'gender' => 'Male',
            'mobile'=>'9090909090'
        ]);
    }
}
