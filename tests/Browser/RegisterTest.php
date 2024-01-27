<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    use DatabaseMigrations;

    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'user')
                ->type('email', 'user@user.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('register')
                ->assertPathIs('/dashboard');
        });
    }
}
