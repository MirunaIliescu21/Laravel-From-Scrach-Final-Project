<?php

use App\Models\User;

it('logs in a user', function () {
    $user = User::factory()->create(['password' => 'john1234']);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'john1234')
        ->press('@login-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();
});

it('logs out a user', function () {
    // create a user
    $user = User::factory()->create();

    // set them as the authentificated user
    $this->actingAs($user);

    // visit the home page and click de Log Out button
    visit('/')->press('Log Out');

    // now we are log out
    $this->assertGuest();
});
