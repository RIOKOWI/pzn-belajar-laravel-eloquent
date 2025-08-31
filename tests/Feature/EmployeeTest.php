<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Database\Factories\EmployeeFactory;
use Illuminate\Foundation\Testing\WithFaker;

use function PHPUnit\Framework\assertNotNull;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    // factory
    public function testFactory(): void
    {
        $employee1 = Employee::factory()->programmer()->create([
            'id' => '1',
            'name' => 'asep balon'
        ]);
        assertNotNull($employee1);

        $employee2 = Employee::factory()->seniorProgrammer()->create([
            'id' => '2',
            'name' => 'udin kesenggol'
        ]);
        assertNotNull($employee2);
    }
}
