<?php

namespace Tests\Feature;

use App\Models\Person;
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
        
        assertEquals('rio achyar', $person->full_name);
        
        $person->full_name = 'embut cepong';
        $person->save();

        assertEquals('embut', $person->first_name);
        assertEquals('cepong', $person->last_name);
    }
}
