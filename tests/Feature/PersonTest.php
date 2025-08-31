<?php

namespace Tests\Feature;

use App\Models\Person;
use Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

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
}
