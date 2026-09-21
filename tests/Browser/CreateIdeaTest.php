<?php

use App\Models\Idea;
use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'New test idea.')
        ->click('@button-status-completed')
        ->fill('description', 'The test performed well.')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'New test idea.',
        'status' => 'completed',
        'description' => 'The test performed well.',
    ]);    
});