<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image = new Image();
        $image->url = 'https://www.reddit.com/';
        $image->imageable_id = 'RIO';
        $image->imageable_type = 'customer'; // polymorphic types
        $image->save();

        $image = new Image();
        $image->url = 'https://www.reddit.com/';
        $image->imageable_id = '1';
        $image->imageable_type = 'product'; // polymorphic types
        $image->save();
    }
}
