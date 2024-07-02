<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function basic_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}