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
        Schema::create('article_provider', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('article_id');
            $table->foreignUuid('provider_id');
            $table->decimal('article_price',total:10,places:2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_provider');
    }
};
