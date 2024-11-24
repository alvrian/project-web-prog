<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 5 ; $i++) { 
            $user = User::create([
                'username' => fake()->name(),
                'age' => fake()->randomNumber(2)
            ]);
            for ($j=0; $j <5 ; $j++) { 
                $user->tweets()->create([
                'tweet' => fake()->sentence(6),
                ]);
            }
        }
        // for ($i=1; $i <= 5; $i++) { 
        //     DB::table('users')->insert([
        //         'username' => fake()->name(),
        //         'age' => fake()->randomNumber(2),
        //     ]);
        // }

        
        
    }
}
