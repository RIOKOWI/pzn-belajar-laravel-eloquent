<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $review = new Review();
        $review->product_id = '1';
        $review->customer_id = 'RIO';
        $review->rating = 1;
        $review->comments = 'barang petjah';
        $review->save();

        $review = new Review();
        $review->product_id = '2';
        $review->customer_id = 'RIO';
        $review->rating = 5;
        $review->comments = 'murah bingit';
        $review->save();
    }
}
