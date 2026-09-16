<?php

it('register a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@example.com')
        ->fill('password', 'john1234')
        ->press('Create Account')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

it('requires a valid email address', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'johnexample.com')
        ->fill('password', 'john1234')
        ->press('Create Account')
        ->assertPathIs('/register');
});
