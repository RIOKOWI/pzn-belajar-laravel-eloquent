<?php

namespace Database\Seeders;

use App\Models\Comment as ModelsComment;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createCommentsForProducts();
        $this->createCommentsForVouchers();
    }
    
    public function createCommentsForProducts(): void
    {
        $product = Product::find('1');

        $comment = new Comment();
        $comment->email = 'rio@gmail.com';
        $comment->title = 'kritik';
        $comment->comment = 'jelek';
        $comment->commentable_id = $product->id;
        $comment->commentable_type = Product::class;
        $comment->save();
    }

    public function createCommentsForVouchers(): void
    {
        $voucher = Voucher::first();

        $comment = new Comment();
        $comment->email = 'rio@gmail.com';
        $comment->title = 'kritik';
        $comment->comment = 'voucher nya hangus';
        $comment->commentable_id = $voucher->id;
        $comment->commentable_type = Voucher::class;
        $comment->save();
    }
}
