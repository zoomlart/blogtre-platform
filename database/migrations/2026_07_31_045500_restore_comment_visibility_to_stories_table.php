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
        if (! Schema::hasColumn('stories', 'comment_visibility')) {
            Schema::table('stories', function (Blueprint $table) {
                $table->string('comment_visibility')->default('Allow')->after('featured')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('stories', 'comment_visibility')) {
            Schema::table('stories', function (Blueprint $table) {
                $table->dropColumn('comment_visibility');
            });
        }
    }
};
