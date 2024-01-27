<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */

    use DatabaseMigrations;

    public function testExample(): void
    {

        $user = User::factory()->create([
            'email' => 'taylor@laravel.com',]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'taylor@laravel.com')
                ->type('password', 'password')
                ->press('submit')
                ->assertPathIs('/dashboard');
        });
    }
}
