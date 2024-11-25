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
        Schema::create('user_aid_selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('aid_type_id')->constrained('aid_types')->onDelete('cascade');
            $table->foreignId('aid_category_id')->constrained('aid_categories')->onDelete('cascade');
            $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_aid_selections');
    }
};
