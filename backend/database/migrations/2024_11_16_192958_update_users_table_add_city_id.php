<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Dodanie kolumny city_id jako klucz obcy
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade'); // Dodaj klucz obcy do tabeli cities
        });
    }

    public function down()
    {
        // Usunięcie kolumny city_id, gdyby migracja została cofnięta
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};
