<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = [
            'annie-spratt-121576-unsplash.jpg',
            'andy-lee-642320-unsplash.jpg',
            'benjamin-parker-699522-unsplash.jpg',
            'freestocks-org-190062-unsplash.jpg',
            'joshua-rawson-harris-432289-unsplash.jpg',
            'nicolas-horn-689011-unsplash.jpg',
        ];

        collect($files)->each(function ($file) {
            \App\File::create([
                'name' => $file,
                'file' => 'public/avatars/' . $file,
            ]);
        });
    }
}
