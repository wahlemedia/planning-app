<?php

declare(strict_types=1);

use App\Models\Topic;
use App\Models\Moderator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moderator_topic', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Moderator::class)
                ->onDelete('cascade');
            $table->foreignIdFor(Topic::class)
                ->onDelete('cascade');

            $table->datetime('held_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderator_topics');
    }
};
