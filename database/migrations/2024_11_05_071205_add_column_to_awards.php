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
        Schema::table('awards', function (Blueprint $table) {
            $table->unsignedBigInteger('award_category_id', false)->after('id');
            $table->foreign('award_category_id')->references('id')->on('award_categories')->onDelete('restrict')->onUpdate('cascade');
            $table->string('name')->after('award_category_id');
            $table->string('description')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('awards', function (Blueprint $table) {
            $table->dropForeign([
                'award_category_id'
            ]);

            $table->dropColumn([
                'award_category_id'
            ]);

            $table->string('category')->after('id');

            $table->dropColumn(['name', 'description']);

        });
    }
};
