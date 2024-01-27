<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AnotherExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_see_register()
    {
        $response = $this->get('/register');
        $response->assertSee('Confirm Password');
    }

    public function test_see_dashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertDontSee('You\'re logged in!');
    }

    public function test_see_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login',[
            'email'=> $user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('dashboard');
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertSee('You\'re logged in');
    }

    public function test_making_an_api_request_create_transaction()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->postJson('/api/transactions/create', [
            'type'=>'Income',
            'amount'=>'11',
            'title'=>'test api',
            'description'=>'test sample api text',
            'date'=>'2024-01-03'
        ]);

        $response->assertJson([
            'transaction' => true,
        ]);
    }
}
