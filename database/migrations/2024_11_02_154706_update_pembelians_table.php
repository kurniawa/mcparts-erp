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
        Schema::table('pembelians', function (Blueprint $table) {
            // Mengubah tipe data kolom harga_total menjadi bigInteger
            // $table->bigInteger('harga_total')->change();

            // Menambahkan kolom sisa_bayar
            if (!Schema::hasColumn('pembelians', 'sisa_bayar')) {
                $table->decimal('sisa_bayar', 15, 2)->nullable();
            }

            // Mengubah tipe data kolom status_bayar menjadi varchar(20)
            // dan mengubah default value menjadi 'BELUM-LUNAS'
            $table->string('status_bayar', 20)->default('BELUM-LUNAS')->change();

            // mengubah nama kolom dari creator menjadi created_by
            if (Schema::hasColumn('pembelians', 'creator')) {
                $table->renameColumn('creator', 'created_by');
            }

            // mengubah nama kolom dari updater menjadi updated_by
            if (Schema::hasColumn('pembelians', 'updater')) {
                $table->renameColumn('updater', 'updated_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelians', function (Blueprint $table) {
            // Mengembalikan tipe data kolom harga_total ke integer
            $table->decimal('harga_total', 20, 2)->change();

            // Menghapus kolom sisa_bayar
            $table->dropColumn('sisa_bayar');

            // mengembalikan default value ke 'BELUM'
            $table->default('BELUM')->change();

            // mengembalikan nama kolom dari created_by menjadi creator
            $table->renameColumn('created_by', 'creator');

            // mengembalikan nama kolom dari updated_by menjadi created_by
            $table->renameColumn('updated_by', 'created_by');
        });
    }
};
