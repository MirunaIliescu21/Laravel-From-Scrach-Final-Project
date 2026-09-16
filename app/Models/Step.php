<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StepFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Step 8:
 * Create a Step Model:
 * (base) miruna@pink:~/Documents/INFOLOGICA/Laravel/idea$ php artisan make:model

 ┌ What should the model be named? ─────────────────────────────┐
 │ Step                                                         │
 └──────────────────────────────────────────────────────────────┘
 ┌ Would you like any of the following? ────────────────────────┐
 │ Factory                                                      │
 │ Migration                                                    │
 └──────────────────────────────────────────────────────────────┘
   INFO  Model [app/Models/Step.php] created successfully.
   INFO  Factory [database/factories/StepFactory.php] created successfully.
   INFO  Migration [database/migrations/2026_08_31_111133_create_steps_table.php] created successfully.
 * we are accessing this migration for step 9
 */
class Step extends Model
{
    /** @use HasFactory<StepFactory> */
    use HasFactory;

    protected $attributes = [
        'completed' => false,
    ];

    /** Step 11:
     * Add the relationships between the steps of an idea.
     */
    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
