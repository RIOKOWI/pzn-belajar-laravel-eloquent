<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

class VoucherTest extends TestCase
{
    // uuid 
    public function testCreateVoucher(): void
    {
        $voucher = new Voucher()    ;
        $voucher->name = 'rio';
        $voucher->voucher_code = 'rioganteng';
        $result = $voucher->save();

        assertTrue($result);
        assertNotNull($voucher->id);
    }

    public function testCreateVoucherCodeUuid(): void
    {
        $voucher = new Voucher()    ;
        $voucher->name = 'embut';
        $result = $voucher->save();

        assertTrue($result);
        assertNotNull($voucher->id);
        assertNotNull($voucher->voucher_code);
    }

    // soft delete
    public function testSoftDelete(): void
    {
        $this->seed(VoucherSeeder::class);

        $voucher = Voucher::where('name', '=', 'sample voucher')->first();
        $voucher->delete();

        $voucher = Voucher::where('name', '=', 'sample voucher')->first();
        self::assertNull($voucher);

        // ambil data softdelete
        $voucher = Voucher::withTrashed()->where('name', '=', 'sample voucher')->first();
        self::assertNotNull($voucher);
    }

    // query local scope
    public function testLocalScope()
    {
        $voucher = new Voucher();
        $voucher->name = 'sample voucher';
        $voucher->is_active = true;
        $voucher->save();

        $total = Voucher::active()->count();
        assertEquals(1, $total);

        $total = Voucher::nonActive()->count();
        assertEquals(0, $total);

    }

}
