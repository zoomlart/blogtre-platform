<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('vote.votes_table', 'votes'), function (Blueprint $table) {
            $table->id();
            $table->foreignId(config('vote.user_foreign_key', 'user_id'))
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->morphs('votable');
            $table->integer('votes');
            $table->timestamps();

            $table->unique([
                config('vote.user_foreign_key', 'user_id'),
                'votable_id',
                'votable_type',
            ], 'votes_user_votable_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('vote.votes_table', 'votes'));
    }
};
