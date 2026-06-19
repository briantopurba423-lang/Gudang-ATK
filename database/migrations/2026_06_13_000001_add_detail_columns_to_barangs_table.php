<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->string('merek')->nullable()->after('nama');
            $table->string('satuan')->nullable()->after('merek');
            $table->text('deskripsi')->nullable()->after('satuan');
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn(['merek', 'satuan', 'deskripsi']);
        });
    }
};
