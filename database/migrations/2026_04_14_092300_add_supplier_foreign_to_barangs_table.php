<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // supplier_id column is added in a later migration if missing,
        // so we skip the foreign key here to avoid ordering issues.
        // Foreign key is handled after the column exists.
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            if (Schema::hasColumn('barangs', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
            }
        });
    }
};
