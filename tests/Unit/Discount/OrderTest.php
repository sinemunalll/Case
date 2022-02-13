<?php

namespace Tests\Unit\Discount;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->getJson('/api/discounts/order/26');

        $response->assertStatus(200);
    }
}
