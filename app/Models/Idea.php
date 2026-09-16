<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\IdeaStatus;
use App\Models\User;
use App\Models\Step;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Step 1: Create the model
 
 * (base) miruna@pink:~/Documents/INFOLOGICA/Laravel/idea$ php artisan make:model

 ┌ What should the model be named? ─────────────────────────────┐
 │ Idea                                                         │
 └──────────────────────────────────────────────────────────────┘
* And also this in the same step:

 ┌ Would you like any of the following? ────────────────────────┐
 │ Factory                                                      │
 │ Form Requests                                                │
 │ Migration                                                    │
 │ Policy                                                       │
 │ Resource Controller                                          │
 └──────────────────────────────────────────────────────────────┘

   INFO  Model [app/Models/Idea.php] created successfully.  
   INFO  Factory [database/factories/IdeaFactory.php] created successfully.  
   INFO  Migration [database/migrations/2026_08_31_103445_create_ideas_table.php] created successfully.  
* we are accessing this migration for step 2.

   INFO  Request [app/Http/Requests/StoreIdeaRequest.php] created successfully.  
   INFO  Request [app/Http/Requests/UpdateIdeaRequest.php] created successfully.  
   INFO  Controller [app/Http/Controllers/IdeaController.php] created successfully.  
   INFO  Policy [app/Policies/IdeaPolicy.php] created successfully.  
 */

class Idea extends Model
{
    /** @use HasFactory<\Database\Factories\IdeaFactory> */
    use HasFactory;

    /**
     * Step 5:
     * Adding some casting - allows us to cast the value from the database to the correct type.

     * Create the enum -> IdeaStatus.php to use a enum cast for the status field.
     
     * (base) miruna@pink:~/Documents/INFOLOGICA/Laravel/idea$ php artisan make:enum
    
      ┌ What should the enum be named? ──────────────────────────────┐
      │ IdeaStatus                                                   │
      └──────────────────────────────────────────────────────────────┘
      ┌ Which type of enum would you like? ──────────────────────────┐
      │ Backed enum (String)                                         │
      └──────────────────────────────────────────────────────────────┘
        INFO  Enum [app/IdeaStatus.php] created successfully. 
     */

    protected $casts = [
      'links' => AsArrayObject::class,
      'status' => IdeaStatus::class,
    ];

    /**
     * Step 14:
     * Initial attributes.
    
     * I set here the status and I will get 'pending' even though
     * in our IdeaFactory we didn't set a status:
     * php artisan tinker
      > $idea = App\Models\Idea::factory()->make();

      = App\Models\Idea {#7606
          status: App\IdeaStatus {#7631
            +name: "PENDING",
            +value: "pending",
          },
          user_id: 5,
          title: "Et error cumque dolorem.",
          description: "Vitae laudantium sit ad eveniet minima ut. Explicabo veniam dolor cum doloribus qui asperiores aut. Est eos dolores quos voluptas deserunt. Aut harum magnam laborum ut vel soluta enim.",
          links: "[\"https:\\/\\/www.orn.com\\/voluptate-qui-error-nam-vitae-corporis-maxime\"]",
        }
     */
    protected $attributes = [
      'status' => IdeaStatus::PENDING,
    ];

    /**
     * Step 7:
     * Add the relationships:
     * - each idea belongs to a user
     * - each idea has many steps
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class); // we dont have a Step Model -> create one!
    }

    public static function statusCounts(User $user) : Collection
    {
      // select status, count(*) from ideas group by status;
      $counts = $user->ideas()
        ->selectRaw('status, count(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status');

      return collect(IdeaStatus::cases())
        ->mapWithKeys(fn($status) => [
            $status->value => $counts->get($status->value, 0),
        ])
        ->put('all', $user->ideas()->count());
    }
}
