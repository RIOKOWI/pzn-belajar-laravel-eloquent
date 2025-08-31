<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Scopes\IsActiveScope;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ReviewSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
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
        // $result = Category::insert($categories);
        $result = Category::withoutGlobalScopes([IsActiveScope::class])->insert($categories);
        assertTrue($result);

        // $total = Category::query()->count();
        // $total = Category::count();
        $total = Category::withoutGlobalScopes([IsActiveScope::class])->count();
        assertEquals(10, $total);

    }
    
    // find
    public function testFind()
    {
        $this->seed(CategorySeeder::class);
        
        // $category = Category::query()->find();
        // $category = Category::find('FOOD');
        $category = Category::withoutGlobalScopes([IsActiveScope::class])->find('FOOD');
        assertNotNull($category);
        assertEquals('FOOD', $category->id);
        assertEquals('food', $category->name);
        assertEquals('food category', $category->description);
    }
    
    // UPDATE
    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        // $category = Category::find('FOOD');
        $category = Category::withoutGlobalScopes([IsActiveScope::class])->find('FOOD');
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
        
        // $categories = Category::whereNull('description')->get();
        $categories = Category::withoutGlobalScopes([IsActiveScope::class])->whereNull('description')->get();

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
        
        // $result = Category::insert($categories);
        $result = Category::withoutGlobalScopes([IsActiveScope::class])->insert($categories);
        assertEquals(10, $result);
        
        // Category::whereNull('description')->update([
        //     'description' => 'update many'
        // ]);
        Category::withoutGlobalScopes([IsActiveScope::class])->whereNull('description')->update([
            'description' => 'update many'
        ]);

        // $total = Category::where('description', '=', 'update many')->get();
        $total = Category::withoutGlobalScopes([IsActiveScope::class])->where('description', '=', 'update many')->get();
        self::assertEquals(10, $total->count());
    }

    // DELETE
    public function testDelete()
    {
        $this->seed(CategorySeeder::class);

        // $category = Category::find('FOOD');
        $category = Category::withoutGlobalScopes([IsActiveScope::class])->find('FOOD');
        $result = $category->delete();
        assertTrue($result);
        
        // $total = Category::count();
        $total = Category::withoutGlobalScopes([IsActiveScope::class])->count();
        assertEquals(0, $total);
    }
    
    // DELETE MANY
    public function testDeleteMany()
    {
        $categories = [];
        for($i = 0; $i < 10; $i++){
            $categories [] = [
                'id' => "ID $i",
                'name' => "NAME $i"
            ];
        }

        // $result = Category::insert($categories);
        $result = Category::withoutGlobalScopes([IsActiveScope::class])->insert($categories);
        assertTrue($result);

        // $total = Category::count();
        $total = Category::withoutGlobalScopes([IsActiveScope::class])->count();
        assertEquals(10, $total);

        // Category::whereNull('description')->delete();
        Category::withoutGlobalScopes([IsActiveScope::class])->whereNull('description')->delete();
        $end = Category::count();
        assertEquals(0, $end);
    }
    

    // fillable attribue values
    public function testCreateCategory()
    {
        $request = [
            'id' => 'FOOD',
            'name' => 'food category' ,
            'description' => 'sample dscription'
        ];

        $categories = new Category($request);
        $categories->save();

        assertNotNull($categories->id);
    }

    public function testCreateMethod()
    {
        $request = [
            'id' => 'FOOD',
            'name' => 'food category' ,
            'description' => 'sample dscription'
        ];

        $categories = Category::query()->create($request);

        assertNotNull($categories->id);
    }

    public function testUpdateMethod()
    {
        $this->seed(CategorySeeder::class);

        $request = [
            'name' => 'food category' ,
            'description' => 'mbut dscription'
        ];

        // $categories = Category::find('FOOD');
        $categories = Category::withoutGlobalScopes([IsActiveScope::class])->find('FOOD');
        $categories->fill($request);
        $categories->save();

        assertNotNull($categories->id);
    }

    // global scope
    public function testRemoveGlobalScope()
    {
        $category = new Category();
        $category->id = 'FOOD';
        $category->name = 'food';
        $category->description = 'sample desc';
        $category->is_active = false;
        $category->save();

        $category = Category::find('FOOD');
        self::assertNull($category);
        
        $category = Category::withoutGlobalScopes([IsActiveScope::class])->find('FOOD');
        self::assertNotNull($category);
    }
    
    // one to many
    public function testCategoryOtm()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::find('FOOD');
        assertNotNull($category);

        $products = $category->products;
        assertNotNull($products);
        assertEquals(2, $products->count());
    }


    //query builder realtionship
    public function testOtmQbr()
    {
        $category = new Category();
        $category->id = 'SOTO';
        $category->name = 'soto';
        $category->description = 'kuah';
        $category->is_active = true;
        $category->save();

        $product = new Product();
        $product->id = '1';
        $product->name = 'soto ayam';
        $product->description = 'wuenak';
        $product->price = 15000;
        $product->stock = 100;
        $category->products()->save($product);

        assertNotNull($product->category_id);
    }

    public function testSearchProduct()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::find('FOOD');
        $products = $category->products;
        assertCount(2, $products);

        $stokHabis = $category->products()->where('stock', '<=', 0)->get();
        assertCount(0, $stokHabis);
    }

    // has many through
    public function testHasManyThrough()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, CustomerSeeder::class, ReviewSeeder::class]);

        $category = Category::find('FOOD');
        assertNotNull($category);

        $review = $category->review;
        assertNotNull($review);
        assertCount(2, $review);
    }
    

    //querying relations
    public function testQueryingRelations()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::find('FOOD');
        $product = $category->products()->where('price', '=', 20000)->get();
        assertCount(1, $product);
        assertEquals('1', $product[0]->id);
    }

    //aggregating relations
    public function testAggregatingRelations()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);
        
        $category = Category::find('FOOD');
        $totalProduct = $category->products()->count();
        assertEquals(2, $totalProduct);
        
        $totalProductPrice = $category->products()->where('price', '=', 1000)->count();
        assertEquals(1, $totalProductPrice);
        
    }

    // eloquent collection
    public function testEloquentCollection()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $product = Product::get();
        assertCount(2, $product);

        $product = $product->toQuery()->where('price', '=', 1000)->get();
        assertNotNull($product);
        assertEquals('2', $product[0]->id);

    }

}
