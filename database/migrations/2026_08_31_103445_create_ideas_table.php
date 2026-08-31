<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

/**
 * Step 2:
 * 
 * What does an idea consist off ?
 * - id
 * - foreign id for our User model (user_id)
 * - title
 * - description
 * - status (pending, in progress, completed)
 * - image path
 * - each idea has a list of steps (links = empty array by default)
 * - timestamp
 * 
 * Step 3:
 * Migrate the database:
 * 
 * miruna@pink:~/Documents/INFOLOGICA/Laravel/idea$ php artisan migrate

   INFO  Running migrations.  
  2026_08_31_103445_create_ideas_table .................................................. 8.06ms DONE
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->string('image_path')->nullable();
            $table->json('links')->default('[]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
