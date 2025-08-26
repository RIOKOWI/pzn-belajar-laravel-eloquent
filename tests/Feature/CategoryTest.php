<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
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
    
    // find
    public function testFind()
    {
        $this->seed(CategorySeeder::class);
        
        // $category = Category::query()->find();
        $category = Category::find('FOOD');
        assertNotNull($category);
        assertEquals('FOOD', $category->id);
        assertEquals('food', $category->name);
        assertEquals('food category', $category->description);
    }
    
    // UPDATE
    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find('FOOD');
        $category->name = 'food update';
        $result = $category->update();
        
        assertTrue($result);
    }
    
    // SELECT
    public function testSelect()
    {
        for($i = 0; $i < 5; $i++){
            $category = new Category();
            $category->id = "ID $i";
            $category->name = "NAME $i";
            $category->save();
        }
        
        $categories = Category::whereNull('description')->get();
        assertEquals(5, $categories->count());
        $categories->each(function ($category){
            self::assertNull($category->description);
        });
        
        // bisa di update
        $categories->each(function ($category){
            $category->description = 'updated';
            $category->update();
        });
        
    }
    
    // UPDATE MANY
    public function testUpdateMany()
    {
        $categories = [];
        for($i = 0; $i < 10; $i++){
            $categories [] = [
                'id' => "ID $i",
                'name' => "NAME $i"
            ];
        }
        
        $result = Category::insert($categories);
        assertEquals(10, $result);

        Category::whereNull('description')->update([
            'description' => 'update many'
        ]);
        $total = Category::where('description', '=', 'update many')->get();
        self::assertEquals(10, $total->count());
    }

    // DELETE
    public function testDelete()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find('FOOD');
        $result = $category->delete();
        assertTrue($result);

        $total = Category::count();
        assertEquals(0, $total);
    }


}
