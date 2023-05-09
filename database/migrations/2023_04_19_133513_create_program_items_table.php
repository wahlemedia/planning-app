<?php

declare(strict_types=1);

use App\Models\Program;
use App\Models\Topic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('program_items', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Program::class)
                ->cascadeOnDelete();

            $table->foreignIdFor(Topic::class)
                ->nullable()
                ->nullOnDelete();

            $table->integer('order_column')
                ->default(0);

            $table->dateTime('started_at')
                ->nullable();

            $table->dateTime('ended_at')
                ->nullable();

            $table->string('notes')
                ->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_items');
    }
};
