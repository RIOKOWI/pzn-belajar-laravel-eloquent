<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Wallet;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
