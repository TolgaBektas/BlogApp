<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <10 ; $i++) { 
            $faker = Factory::create();
            User::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password'=>bcrypt('12345678')
            ]);
        }
        User::create([
            'name'=>'admin',
            'email'=>'tolgabektas00@gmail.com',
            'password'=>bcrypt('12345678')
        ]);
    }
}
