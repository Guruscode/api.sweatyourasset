<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdvertisementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Advertisement::create([
                'title' => "Advertisement $i",
                'content' => "Content of Advertisement $i",
                'image_url' => null,
                'link_url' => null,
            ]);
        }
    }
}
