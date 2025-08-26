<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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

}
