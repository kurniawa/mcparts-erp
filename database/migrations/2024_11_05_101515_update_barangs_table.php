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
        Schema::table('barangs', function (Blueprint $table) {
            // Mengubah tipe data jumlah_main dan jumlah_sub dari integer ke decimal(10, 2)
            $table->decimal('jumlah_main', 10, 2)->change();
            $table->decimal('jumlah_sub', 10, 2)->nullable()->change();

            // Mengubah tipe data harga_main dari decimal(20, 2) menjadi decimal(15, 2)
            $table->decimal('harga_main', 15, 2)->change();

            // Mengubah tipe data harga_sub dari decimal(20, 2) menjadi decimal(15, 2)
            $table->decimal('harga_sub', 15, 2)->nullable()->change();

            // Mengubah tipe data harga_total_main dari decimal(20, 2) menjadi decimal(15, 2)
            $table->decimal('harga_total_main', 15, 2)->change();

            // Mengubah tipe data harga_total_sub dari decimal(20, 2) menjadi decimal(15, 2)
            $table->decimal('harga_total_sub', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            // Mengubah tipe data jumlah_main dan jumlah_sub dari integer ke decimal(10, 2)
            $table->integer('jumlah_main')->change();
            $table->integer('jumlah_sub')->nullable()->change();

            // Mengubah tipe data harga_main kembali ke decimal(20, 2)
            $table->decimal('harga_main', 20, 2)->change();

            // Mengubah tipe data harga_sub kembali ke decimal(20, 2)
            $table->decimal('harga_sub', 20, 2)->nullable()->change();

            // Mengubah tipe data harga_total_main kembali ke decimal(20, 2)
            $table->decimal('harga_total_main', 20, 2)->change();

            // Mengubah tipe data harga_total_sub kembali ke decimal(20, 2)
            $table->decimal('harga_total_sub', 20, 2)->nullable()->change();
        });
    }
};
