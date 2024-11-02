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
        Schema::table('notas', function (Blueprint $table) {
            // Menambahkan kolom sisa_bayar
            if (!Schema::hasColumn('notas', 'sisa_bayar')) {
                $table->bigInteger('sisa_bayar')->default(0)->notNullable();
            }

            // Mengubah tipe data kolom jumlah_total menjadi mediumInteger
            $table->mediumInteger('jumlah_total')->change();
            // Mengubah tipe data kolom harga_total menjadi bigInteger
            $table->bigInteger('harga_total')->change();

            // Menambahkan kolom tanggal_lunas dengan tipe data timestamp
            if (!Schema::hasColumn('notas', 'tanggal_lunas')) {
                $table->timestamp('tanggal_lunas')->nullable();
            }
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
        Schema::table('notas', function (Blueprint $table) {
            // Menghapus kolom sisa_bayar
            $table->dropColumn('sisa_bayar');

            // Mengembalikan tipe data kolom jumlah_total ke integer
            $table->integer('jumlah_total')->change();
            // Mengembalikan tipe data kolom harga_total ke integer
            $table->integer('harga_total')->change();
            // Menghapus kolom tanggal_lunas
            $table->dropColumn('tanggal_lunas');
            // Mengembalikan tipe data kolom ke varchar(50)
            // dan default value ke 'belum'
            $table->string('status_bayar', 50)->default('belum')->change();
        });
    }
};
