<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 3; $i++) {
            Video::create([
                'title' => 'Intro '.$i,
                'category' => 'orientation',
                'order' => $i + 1,
                'description' => 'Orientation '. $i . ' description',
                'path' => 'videos/orientation/orientation_sample'. $i + 1 . '.mp4'
            ]);
        }

        for ($i=0; $i < 3; $i++) {
            Video::create([
                'title' => 'Intro '.$i,
                'category' => 'training',
                'order' => $i + 1,
                'description' => 'Training '. $i . ' description',
                'path' => 'videos/training/training_sample'. $i + 1 . '.mp4'
            ]);
        }

        for ($i=0; $i < 3; $i++) {
            Video::create([
                'title' => 'Intro '.$i,
                'category' => 'correction',
                'order' => $i + 1,
                'description' => 'Correction '. $i . ' description',
                'path' => 'videos/correction/correction_sample'. $i + 1 . '.mp4'
            ]);
        }
    }
}
