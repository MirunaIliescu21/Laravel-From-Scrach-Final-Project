<?php

use App\Models\Idea;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Step 9:
 *
 * Wht does a step consists off ?
 *
 * - id
 * - foreing id for the idea
 * - description
 * - boolean for completed
 * - timestamp
 *
 * Step 10:
 *
 * Migrate the database:
 *
 * (base) miruna@pink:~/Documents/INFOLOGICA/Laravel/idea$ php artisan migrate
   INFO  Running migrations.
   2026_08_31_111133_create_steps_table ................................................................................................. 3.85ms DONE
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Idea::class)->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
