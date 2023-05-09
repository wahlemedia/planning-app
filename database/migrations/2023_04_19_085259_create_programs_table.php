<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->uuid('id');

            $table->string('title');
            $table->string('slug')
                ->unique();

            $table->string('description')
                ->nullable();

            $table->date('start_date')
                ->nullable();

            $table->date('end_date')
                ->nullable();

            $table->string('state')
                ->default('draft');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
