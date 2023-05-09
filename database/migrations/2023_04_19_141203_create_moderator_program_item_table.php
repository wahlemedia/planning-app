<?php

declare(strict_types=1);

use App\Models\Moderator;
use App\Models\ProgramItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moderator_program_item', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Moderator::class)
                ->onDelete('cascade');

            $table->foreignIdFor(ProgramItem::class)
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderator_program_item');
    }
};
