<?php

namespace Tests\Unit\Order;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Tests\TestCase;

class StoreTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->postJson('/api/orders', ['customerId' => '1','total'=>'10','items'=>'[{ "productId": 1, "quantity": 10, "unitPrice": "120.75", "total": "1207.50" }, { "productId": 2, "quantity": 6, "unitPrice": "11.28", "total": "67.68" }]']);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                $response['message']
            ]);
    }
}
