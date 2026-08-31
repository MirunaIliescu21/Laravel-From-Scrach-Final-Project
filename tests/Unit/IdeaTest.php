<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Insert / create an idea into the DB.
 * And then we access a relationship using Eloquent.
 */
test('it belongs to a user', function () {
    $idea = Idea::factory()->create();
    expect($idea->user)->toBeInstanceOf(User::class);
});

/**
 * We create an idea.
 * But withour creating also some steps.
 * Returns a null collection of steps.
 * 
 * Then add a step, refresh the idea 
 * and it will have exactly 1 item. 
 */
test('it can have steps', function () {
    $idea = Idea::factory()->create();
    // expect($idea->steps)->toBeInstanceOf(Collection::class);
    expect($idea->steps)->toBeEmpty();

    $idea->steps()->create([
        'description' => 'Read first.',

    ]);

    expect($idea->fresh()->steps)->toHaveCount(1);
});