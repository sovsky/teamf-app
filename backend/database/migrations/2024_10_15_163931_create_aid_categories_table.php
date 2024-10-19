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
        Schema::create('aid_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_of_aid_id')->constrained('type_of_aid')->onDelete('cascade');//materialna, psychologiczna, medyczna, budowlana, logicznyczna
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aid_categories');
    }
};
