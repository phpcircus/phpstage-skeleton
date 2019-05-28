<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function home_route_redirects_to_dashboard()
    {
        $response = $this->get('/');

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function unauthenticated_user_cannot_visit_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }
}
