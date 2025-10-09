<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topic_configs', function (Blueprint $table) {
            $table->string('topic')->nullable(false);
            $table->foreign('topic')->references('name')->on('topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('max_posts')->nullable(false);
            $table->integer('max_replies')->nullable(false);
            $table->integer('max_files')->nullable(false);
            $table->integer('post_per_user')->nullable(false);
            $table->integer('duration_minutes')->nullable(false);
            $table->primary('topic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_configs');
    }
};
