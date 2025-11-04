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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('topic')->nullable(false);
            $table->foreign('topic')->references('name')->on('topics')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('title', 100)->nullable(false);
            $table->longText('content')->nullable(false);

            $table->enum('status', ['archived', 'queued', 'active', 'pinned'])->nullable(false)->default('queued');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumn('posts');
    }
};
