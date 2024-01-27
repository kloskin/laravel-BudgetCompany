<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
   /* public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/login')
                ->screenshot('sc1');
        });
    }*/
}
