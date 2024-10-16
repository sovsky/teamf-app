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
        Schema::rename('type_of_aid', 'aid_types');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('aid_types', 'type_of_aid');
    }
};
