<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/login')
                    ->type('email', 'tiffany.zieme@example.org')
                    ->type('password', 'password')
                    ->click('.btn-login')
                    ->assertPathIs('/');
        });
    }

    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/login')
                    ->type('email', 'tiffany.zieme@example.org')
                    ->type('password', 'password123')
                    ->click('.btn-login')
                    ->assertPathIs('/login');
        });
    }
}
