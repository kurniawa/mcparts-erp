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
        Schema::table('pembelian_barangs', function (Blueprint $table) {
            // Mengubah tipe data harga_main dari decimal(20, 2) menjadi decimal(15, 2)
            $table->decimal('harga_main', 15, 2)->change();

            // Mengubah tipe data harga_sub dari decimal(20, 2) menjadi decimal(15, 2)
            $table->decimal('harga_sub', 15, 2)->nullable()->change();

            // Mengubah tipe data harga_t dari decimal(20, 2) menjadi decimal(15, 2)
            $table->decimal('harga_t', 15, 2)->change();

            // Mengubah tipe data jumlah_main dari integer) menjadi decimal(15, 2)
            $table->decimal('jumlah_main', 15, 2)->change();

            // Mengubah tipe data jumlah_sub dari integer) menjadi decimal(15, 2)
            $table->decimal('jumlah_sub', 15, 2)->nullable()->change();

            // Mengubah tipe data kolom status_bayar menjadi varchar(20)
            // dan mengubah default value menjadi 'BELUM-LUNAS'
            $table->string('status_bayar', 20)->default('BELUM-LUNAS')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian_barangs', function (Blueprint $table) {
            // Mengubah tipe data harga_main kembali menjadi decimal(20, 2)
            $table->decimal('harga_main', 20, 2)->change();

            // Mengubah tipe data harga_sub kembali menjadi decimal(20, 2)
            $table->decimal('harga_sub', 20, 2)->nullable()->change();

            // Mengubah tipe data harga_t kembali menjadi decimal(20, 2)
            $table->decimal('harga_t', 20, 2)->change();

            // Mengubah tipe data jumlah_main kembali ke integer
            $table->integer('jumlah_main')->change();

            // Mengubah tipe data jumlah_sub kembali ke integer
            $table->integer('jumlah_sub')->nullable()->change();

            // Mengubah tipe data kolom status_bayar kembali ke varchar(20)
            // dan mengubah default value kembali ke 'BELUM'
            $table->string('status_bayar', 20)->default('BELUM')->change();
        });
    }
};
