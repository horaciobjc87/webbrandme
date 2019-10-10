<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandmeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample() //testeo de que la vista me genere un status 200 y que todo este correcto
    {
        $this->get('/brandme')
          ->assertStatus(200);
    }
}
