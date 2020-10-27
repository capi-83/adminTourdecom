<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * Test no auth
     *
     * @test
     * @return void
     */
    public function routeNoAuthTest()
    {
        $response = $this->get('/');
        $response->assertStatus(302);

        $response = $this->get('/dashboard');
        $response->assertStatus(302);

        $response = $this->get('/login');
        $response->assertSuccessful();

        $response = $this->get('/password/reset');
        $response->assertSuccessful();
    }

    /**
     * Test auth
     *
     * @test
     * @return void
     */
    public function routeAuthTest()
    {

        $this->loginWithFakeAdminUser();

        $response = $this->get('/dashboard');
        $response->assertSuccessful();

        $response = $this->get('/');
        $response->assertStatus(302);

        $response = $this->get('/login');
        $response->assertStatus(302);


    }

    public function loginWithFakeAdminUser()
    {
        $user = new User([
            'id' => 1,
            'name' => 'SuperAdmin'
        ]);

        $this->be($user);
    }
}
