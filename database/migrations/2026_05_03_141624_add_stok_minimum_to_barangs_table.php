<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            if (!Schema::hasColumn('barangs', 'stok_minimum')) {
                $table->integer('stok_minimum')->default(5)->after('stok');
            }
            if (!Schema::hasColumn('barangs', 'supplier_id')) {
                $table->unsignedBigInteger('supplier_id')->nullable()->after('kategori_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            if (Schema::hasColumn('barangs', 'stok_minimum')) {
                $table->dropColumn('stok_minimum');
            }
            if (Schema::hasColumn('barangs', 'supplier_id')) {
                $table->dropColumn('supplier_id');
            }
        });
    }
};
