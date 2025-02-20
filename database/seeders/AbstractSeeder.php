<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UploadAbstract;
use Faker\Factory as Faker;

class AbstractSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        
        $filePath = 'storage/abstracts/upload_test_abstract.pdf';
        

        $authors = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'author');
        })->get();

        foreach ($authors as $author) {

            $originalName = $faker->unique()->lexify('Abstract_?????.pdf');

            UploadAbstract::create([
                'user_id' => $author->id,
                'file_path' => $filePath,
                'original_name' => $originalName,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => 'pending',
                'reviewer_id' => null,
            ]);
        }
    }
}