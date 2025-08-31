<?php

namespace Tests\Feature;

use App\Models\Address;
use Attribute;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Person;
use Carbon\Carbon as CarbonCarbon;
use function PHPUnit\Framework\assertEquals;
use Illuminate\Foundation\Testing\WithFaker;

use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertInstanceOf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

class PersonTest extends TestCase
{
    // accessors & mutators
    public function testPerson()
    {
        $person = new Person();
        $person->first_name = 'rio';
        $person->last_name = 'achyar';
        $person->save();
        
        assertEquals('RIO achyar', $person->full_name);
        
        $person->full_name = 'embut cepong';
        $person->save();

        assertEquals('EMBUT', $person->first_name);
        assertEquals('cepong', $person->last_name);
    }

    public function testColumnPerson()
    {
        $person = new Person();
        $person->first_name = 'rio';
        $person->last_name = '';
        $person->save();

        assertEquals('RIO', $person->first_name);
    }

    // attribute casting
    public function testAttributeCasting()
    {
        $person = new Person();
        $person->first_name = 'rio';
        $person->last_name = 'cukuruk';
        $person->save();

        assertNotNull($person->created_at);
        assertNotNull($person->updated_at);
        assertInstanceOf(Carbon::class, $person->updated_at);
        assertInstanceOf(Carbon::class, $person->updated_at);
    }

    // custom cast
    public function testCustomCast()
    {
        $person = new Person();
        $person->first_name = 'rio';
        $person->last_name = 'achyar';
        $person->address = new Address('taman merpati', 'tangerang', 'indonesia', '15560');
        $person->save();

        assertNotNull($person);
        assertEquals('RIO' ,$person->first_name);
        assertEquals('achyar', $person->last_name);
        assertEquals('taman merpati', $person->address->street);
        assertEquals('tangerang', $person->address->city);
        assertEquals('indonesia', $person->address->country);
        assertEquals('15560', $person->address->postal_code);
    }
}
