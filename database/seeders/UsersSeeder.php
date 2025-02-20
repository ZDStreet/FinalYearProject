<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Manually create one admin with set details
        $specificAdmin = User::create([
            'name' => 'Zak Street',
            'email' => 'zak.street@yahoo.co.uk',
            'password' => Hash::make('password'),
        ]);
        $specificAdmin->assignRole('admin');

        // Create one more admin
        $anotherAdmin = User::create([
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'),
        ]);
        $anotherAdmin->assignRole('admin');

        // Create 4 chairs
        for ($i = 0; $i < 4; $i++) {
            $chair = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
            $chair->assignRole('chair');
        }

        // Create 9 reviewers
        for ($i = 0; $i < 9; $i++) {
            $reviewer = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
            $reviewer->assignRole('reviewer');
        }

        // Create 32 authors
        for ($i = 0; $i < 128; $i++) {
            $author = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
            $author->assignRole('author');
        }
    }
}
