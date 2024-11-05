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
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn([
                'category'
            ]);

            $table->unsignedBigInteger('business_category_id', false)->after('id');
            $table->foreign('business_category_id')->references('id')->on('business_categories')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign([
                'business_category_id'
            ]);

            $table->dropColumn([
                'business_category_id'
            ]);

            $table->string('category')->after('id');
        });
    }
};
