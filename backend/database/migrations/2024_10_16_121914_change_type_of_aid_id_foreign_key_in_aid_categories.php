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
        Schema::table('aid_categories', function (Blueprint $table) {
            $table->dropColumn('type_of_aid_id');
            $table->foreignId('aid_type_id')->constrained('aid_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aid_categories', function (Blueprint $table) {
            $table->dropColumn('aid_type_id');
            $table->foreignId('type_of_aid_id')->constrained('type_of_aid')->onDelete('cascade');
        });
    }
};
