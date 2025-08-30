<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\VirtualAccount;
use App\Models\Wallet;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\VirtualAccountSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class CustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testOneToOne(): void
    {
        $this->seed(CustomerSeeder::class);
        $this->seed(WalletSeeder::class);

        $customer = Customer::find('RIO');
        assertNotNull($customer);
        
        $wallet = $customer->wallet;
        assertNotNull($wallet);

        assertEquals(2000000, $wallet->amount);
    }

    // one to one query builder realtionship
    public function testOneToOneQbr()
    {
        $customer = new Customer();
        $customer->id = 'RIO';
        $customer->name = 'rio';
        $customer->email = 'mbut@gmail.com';
        $customer->save();

        $wallet = new Wallet();
        $wallet->amount = 3000000;
        $customer->wallet()->save($wallet);

        assertNotNull($wallet->customer_id);
    }

    // has one through

    public function testHasOneThrough()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class, VirtualAccountSeeder::class]);

        $customer = Customer::find('RIO');
        assertNotNull($customer);

        $va = $customer->virtualAccount;
        assertNotNull($va);
        assertEquals('BCA', $va->bank);

    }

    // many to many
    public function testLike()
    {
        $this->seed([CustomerSeeder::class, CategorySeeder::class, ProductSeeder::class]);

        $customer = Customer::find('RIO');
        assertNotNull($customer);

        $customer->likesProducts()->attach('1');

        $products = $customer->likesProducts;
        assertCount(1, $products);
        
        assertEquals('1', $products[0]->id);
    }

    public function testDislike()
    {
        $this->testLike();

        $customer = Customer::find('RIO');
        $customer->likesProducts()->detach('1');
        
        $products = $customer->likesProducts;
        assertNotNull($products);
        assertCount(0, $products);
    }

    // intermediate table
    public function testPivot()
    {
        $this->testLike();

        $customer = Customer::find('RIO');
        $products = $customer->likesProducts;

        foreach($products as $product)
        {
            $pivot = $product->pivot;
            assertNotNull($pivot->customer_id);
            assertNotNull($pivot->product_id);
            assertNotNull($pivot->created_at);
        };
    }

    public function testPivotFilter()
    {
        $this->testLike();

        $customer = Customer::find('RIO');
        $products = $customer->likesProductsLastWeek;

        foreach($products as $product)
        {
            $pivot = $product->pivot;
            assertNotNull($pivot->customer_id);
            assertNotNull($pivot->product_id);
            assertNotNull($pivot->created_at);
        };
    }

    // pivot model
    public function testPivotModel()
    {
        $this->testLike();

        $customer = Customer::find('RIO');
        $products = $customer->likesProducts;

        foreach($products as $product)
        {
            $pivot = $product->pivot; // object model like
            assertNotNull($pivot);
            
            $customer = $pivot->customer;
            assertNotNull($customer);
            
            $product = $pivot->product;
            assertNotNull($product);
        };
    }

    //one to one polymorphic
    public function testOneToOnePolymorphic()
    {
        $this->seed([CustomerSeeder::class, ImageSeeder::class]);

        $customer = Customer::find('RIO');
        self::assertNotNull($customer);

        $image = $customer->image;
        self::assertNotNull($image);
        self::assertEquals('https://www.reddit.com/', $image->url);
    }

    public function testOneToOnePolymorphicProduct()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, ImageSeeder::class]);

        $product = Product::find('1');
        self::assertNotNull($product);

        $image = $product->image;
        self::assertNotNull($image);
        self::assertEquals('https://www.reddit.com/', $image->url);
    }
    

    // eager loading defaultnya lazy loading
    public function testEagerLoading()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class, ImageSeeder::class]);

        $customer = Customer::with('image')->find('RIO');
        assertNotNull($customer);
    }
}
