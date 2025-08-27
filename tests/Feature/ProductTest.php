<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

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
}
