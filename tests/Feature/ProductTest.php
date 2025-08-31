<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\Category;
use Database\Seeders\TagSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\VoucherSeeder;
use Illuminate\Support\Facades\Log;
use Database\Seeders\CategorySeeder;
use function PHPUnit\Framework\assertCount;

use function PHPUnit\Framework\assertEquals;
use Illuminate\Foundation\Testing\WithFaker;
use function PHPUnit\Framework\assertNotNull;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    // one to many
    public function testProduct(): void
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);
        
        $products = Product::find('1');
        assertNotNull($products);

        $category = $products->category;
        assertNotNull($category);
        assertEquals('FOOD' ,$category->id);
        assertEquals(1 ,$category->count());

    }

    //has one of many
    public function testSearchProduct()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::find('FOOD');

        $murah = $category->cheapestProduct;
        assertNotNull($murah);
        assertEquals('2', $murah->id);

        $mahal = $category->expensiveProduct;
        assertNotNull($mahal);
        assertEquals('1', $mahal->id);
    }

    // one to meny polymorphic
    public function testOneToManyPolymorphic()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, CommentSeeder::class]);
        
        $product = Product::first();
        $comments = $product->comments;
        assertCount(1, $comments);
        foreach ($comments as $comment){
            assertNotNull($comment);
            assertEquals($product->id, $comment->commentable_id);
            assertEquals('product', $comment->commentable_type); // polymorphic types
        }
    }

    // one of many polymorphic
    public function testOneOfManyPolymorphic()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, CommentSeeder::class]);

        $product = Product::first();
        $comments = $product->comments;

        $comment = $product->latestComment;
        assertNotNull($comment);

        $comment = $product->oldestComment;
        assertNotNull($comment);
        
    }

    // many to many polymorphic
    public function testManyToManyPolymorphic()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, TagSeeder::class]);

        $product = Product::first();
        $tags = $product->tags;
        assertNotNull($tags);
        assertCount(1, $tags);

        foreach ($tags as $tag){
            assertNotNull($tag);
            assertNotNull($tag->id);
            assertNotNull($tag->name);

            $vouchers = $tag->vouchers;
            assertNotNull($vouchers);
            assertCount(1,$vouchers);
        }
    }

    //serialization
    public function testSerialization()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $product = Product::get();
        assertCount(2, $product);

        $json = $product->toJson(JSON_PRETTY_PRINT);
        Log::info($json);
    }
}
