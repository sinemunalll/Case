<?php

namespace Tests\Unit\Discount;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IndexTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->getJson('/api/discounts');

        $response->assertStatus(200);
    }
}
