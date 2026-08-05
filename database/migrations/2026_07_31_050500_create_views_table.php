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
        $connection = config('eloquent-viewable.models.view.connection');
        $tableName = config('eloquent-viewable.models.view.table_name', 'views');
        $schema = Schema::connection($connection);

        if (! $schema->hasTable($tableName)) {
            $schema->create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->morphs('viewable');
                $table->text('visitor')->nullable();
                $table->string('collection')->nullable();
                $table->timestamp('viewed_at')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $connection = config('eloquent-viewable.models.view.connection');
        $tableName = config('eloquent-viewable.models.view.table_name', 'views');

        Schema::connection($connection)->dropIfExists($tableName);
    }
};
