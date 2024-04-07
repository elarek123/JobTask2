<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);

        $response = $this->post('/store', [ 'title' => 'test', 'description' => 'test' ]);
        $response->assertStatus(302);

        $response = $this->put('/task/1', [ 'title' => 'test1', 'description' => 'test1']);
        $response->assertStatus(302);

        $response = $this->post('/task/1/status', [ 'status' => 1]);
        $response->assertStatus(302);

        $response = $this->delete('/task/1');
        $response->assertStatus(302);
    }
}
