<script setup>
import { useForm } from '@inertiajs/vue3';
import {formatCurrencyIDw100, formatNumberDecIDw100} from '../../../../public/js/functions.js';
import * as XLSX from "xlsx";

const props = defineProps({
    pembelians: Object,
    pembelian_barangs_all: Object,
    alamats: Object,
    grand_total: Number,
    lunas_total: Number,
    from: String,
    until: String,
});

const form = useForm({});

const from_dateOnly = new Date(props.from).toLocaleDateString("id-ID");
const until_dateOnly = new Date(props.until).toLocaleDateString("id-ID");

const deletePembelian = (id) => {
    const sure = confirm('Anda yakin ingin hapus pembelian ini?');
    if (sure) {
        form.post(route('pembelians.delete',id));
    }
}

function tableToExcel(table_id, filename) {
    // Ambil elemen HTML tabel
    const table = document.getElementById(table_id);

    // Konversi tabel menjadi worksheet
    const worksheet = XLSX.utils.table_to_sheet(table);

    // Buat workbook
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

    // Ekspor file Excel
    XLSX.writeFile(workbook, filename);
}

</script>
<template>
    <div>
        <div>
            <button class="rounded bg-emerald-200 text-emerald-500 p-1" @click="tableToExcel('pembelian-to-excel', 'pembelians.xlsx')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
            </button>
        </div>
        <div class="text-slate-400 font-semibold">rentang waktu: {{ from_dateOnly }} - {{ until_dateOnly }}</div>
        <div class="text-xs">
            <div class="">
                <div class="grid grid-cols-12">
                    <div class="col-span-2">Grand Total</div>
                    <div class="col-span-4">{{ formatCurrencyIDw100(grand_total - lunas_total) }}</div>
                    <div class="col-span-3">{{ formatCurrencyIDw100(lunas_total) }}</div>
                    <div class="col-span-3">{{ formatCurrencyIDw100(grand_total) }}</div>
                </div>    
            </div>
            <div v-for="(pembelian, index) in pembelians">
                <div tabindex="0" class="collapse border-b border-base-300">
                    <input type="checkbox" :id="'checkbox-'+index">

                    <div class="collapse-title w-full">
                        <div class="grid grid-cols-12 items-center">
                            <div class="col-span-2">
                                <div class="flex">
                                    <div class="flex">
                                        <div v-if="!pembelian.tanggal_lunas">
                                            <div class="rounded p-1 bg-pink-200 text-pink-500 font-bold text-center">
                                                <div class="min-w-max">{{ pembelian.created_at.substring(8,10) }}-{{ pembelian.created_at.substring(5,7) }}</div>
                                                <div class="min-w-max">{{ pembelian.created_at.substring(0,4) }}</div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="rounded p-1 bg-sky-200 text-sky-500 font-bold text-center">
                                                <div class="min-w-max">{{ pembelian.created_at.substring(8,10) }}-{{ pembelian.created_at.substring(5,7) }}</div>
                                                <div class="min-w-max">{{ pembelian.created_at.substring(0,4) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex ml-1 items-center">
                                        <div v-if="pembelian.tanggal_lunas">
                                            <div class="rounded p-1 bg-emerald-200 text-emerald-500 font-bold text-center">
                                                <div class="min-w-max">{{ pembelian.tanggal_lunas.substring(8,10) }}-{{ pembelian.tanggal_lunas.substring(5,7) }}</div>
                                                <div class="min-w-max">{{ pembelian.tanggal_lunas.substring(0,4) }}</div>
                                            </div>
                                        </div>
                                        <span v-else class="font-bold">--</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <a :href="route('pembelians.show', pembelian.id)" class="text-sky-500">
                                    <div class="min-w-max">
                                        <span v-if="alamats[index]">
                                            {{ pembelian.supplier_nama }} - {{ alamats[index].short }}
                                        </span>
                                        <span v-else>
                                            {{ pembelian.supplier_nama }}
                                        </span>
                                    </div>
                                </a>
                                <div v-if="pembelian.keterangan_bayar" class="text-slate-400">( {{ pembelian.keterangan_bayar }} )</div>
                            </div>
                            <div class="col-span-3">
                                <a :href="route('pembelians.show', pembelian.id)" class="text-indigo-500">{{ pembelian.nomor_nota }}</a>
                            </div>
                            <div class="col-span-3">
                                <div class="flex justify-between font-semibold items-center">
                                    <span>{{ formatCurrencyIDw100(pembelian.harga_total) }}</span>
                                    <label :for="'checkbox-'+index" class="hover:cursor-pointer flex">
                                        <div class="border p-1 rounded">></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse-content overflow-auto">
                        <table class="w-full">
                            <tbody>
                                <tr v-for="(pembelian_barang, i_pembelian_barang) in pembelian_barangs_all[index]">
                                    <td>{{ i_pembelian_barang + 1 }}.</td>
                                    <td><div class="min-w-max">{{ pembelian_barang.barang_nama }}</div></td>
                                    <td>
                                        <div v-if="pembelian_barang.satuan_sub" class="min-w-max">
                                            {{ formatNumberDecIDw100(pembelian_barang.jumlah_sub) }} {{ pembelian_barang.satuan_sub }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="min-w-max">
                                            {{ formatNumberDecIDw100(pembelian_barang.jumlah_main) }} {{ pembelian_barang.satuan_main }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="min-w-max">
                                            {{ formatCurrencyIDw100(pembelian_barang.harga_main) }} /{{ pembelian_barang.satuan_main }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex justify-between">
                                            <span>Rp</span>
                                            {{ formatCurrencyIDw100(pembelian_barang.harga_t) }}
                                        </div>
                                    </td>
                                    <td>
                                        <form @submit.prevent="deletePembelian(pembelian.id)">
                                            <div>
                                                <button class="rounded bg-pink-300 text-pink-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <div v-if="!pembelians[index].isi">
                                            Content:
                                            <span v-for="isi in pembelians[index].isi">
                                            -- {{ formatNumberDecIDw100(isi.jumlah) }} {{ isi.satuan }}
                                            </span>
                                        </div>
                                    </td>
                                    <th>Total</th>
                                    <td>
                                        <div class="flex justify-between font-semibold">
                                            <span>Rp</span>
                                            {{ formatCurrencyIDw100(pembelians[index].harga_total) }}
                                            <span>,-</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>