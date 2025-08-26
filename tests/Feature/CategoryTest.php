<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    // insert
    public function testInsert(): void
    {
        $category = new Category();

        $category->id = 'GADGET';
        $category->name = 'samsung';
        $category->description = '';

        $result = $category->save();

        assertTrue($result);
    }

    // insert many
    public function testInsertMany()
    {
        $categories = [];
        for($i = 0; $i < 10; $i++){
            $categories [] = [
                'id' => "ID $i",
                'name' => "NAME $i"
            ];
        }

        // $result = Category::query()->insert($categories);
        $result = Category::insert($categories);
        assertTrue($result);

        // $total = Category::query()->count();
        $total = Category::count();
        assertEquals(10, $total);

    }
}
