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
        Schema::create('user_column_visibilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id', false);
            $table->text('url')->nullable();
            $table->longText('columns')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_column_visibilities');
    }
};
