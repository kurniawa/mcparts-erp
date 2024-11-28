<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import {formatCurrencyIDw100, formatNumberDecIDw100} from '../../../../public/js/functions.js';

const props = defineProps({
    types: Object,
    suppliers: Object,
    barangs: Object,
    prices: Object,
});

console.log(props);
const form = useForm({});

const openBarangIds = ref(new Set()); // Set untuk menyimpan ID barang yang detailnya sedang ditampilkan

const toggleBarangDetail = (barangId) => {
    if (openBarangIds.value.has(barangId)) {
        openBarangIds.value.delete(barangId); // Hilangkan ID jika sudah ada (tutup detail)
    } else {
        openBarangIds.value.add(barangId); // Tambahkan ID jika belum ada (buka detail)
    }
};

const deleteBarang = (id) => {
    const sure = confirm('Anda yakin ingin hapus barang ini?');
    if (sure) {
        form.post(route('barangs.delete',id));
    }
}

</script>
<template>
    <div class="flex justify-center">
        <table class="table-nice text-xs">
            <tbody>
                <template v-for="(supplier, i_supplier) in props.suppliers">
                    <tr><td class="font-bold">{{ supplier.nama }}</td></tr>
                    <template v-for="(barang, i_barang) in props.barangs[i_supplier]">
                        <tr>
                            <td>
                                <a :href="route('barangs.show', barang.id)" class="col-span-4 text-sky-500">
                                    <div class="min-w-max">
                                        {{ barang.nama }}
                                    </div>
                                </a>
                            </td>
                            <td>{{ formatNumberDecIDw100(barang.jumlah_main) }} {{ barang.satuan_main }}</td>
                            <td class="font-bold">{{ formatCurrencyIDw100(barang.harga_main) }}</td>
                            <td class="font-bold">{{ formatCurrencyIDw100(barang.harga_total_main) }}</td>
                            <td>
                                <button v-if="!openBarangIds.has(barang.id)" class="border rounded" @click="toggleBarangDetail(barang.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                                <button v-else class="border rounded" @click="toggleBarangDetail(barang.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr v-if="openBarangIds.has(barang.id)">
                            <td colspan="5">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Satuan Utama</td><td>:</td><td>{{ barang.satuan_main }}</td>
                                            <td>Jumlah</td><td>:</td><td>{{ barang.jumlah_main }}</td>
                                            <td>Harga</td><td>:</td><td>{{ formatCurrencyIDw100(barang.harga_main) }}</td>
                                            <td>Total</td><td>:</td><td>{{ formatCurrencyIDw100(barang.harga_total_main) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Satuan Sub</td><td>:</td><td><span v-if="barang.satuan_sub">{{ barang.satuan_sub }}</span><span v-else>-</span></td>
                                            <td>Jumlah</td><td>:</td>
                                            <td><span v-if="barang.jumlah_sub">{{ barang.jumlah_sub }}</span><span v-else>-</span></td>
                                            <td>Harga</td><td>:</td>
                                            <td><span v-if="barang.harga_sub">{{ formatCurrencyIDw100(barang.harga_sub) }}</span><span v-else>-</span></td>
                                            <td>Total</td><td>:</td><td><span v-if="barang.harga_total_sub">{{ formatCurrencyIDw100(barang.harga_total_sub) }}</span><span v-else>-</span></td>
                                        </tr>
                                        <tr>
                                            <td class="align-bottom">
                                                <div>
                                                    <a :href="route('barangs.edit', barang.id)">
                                                        <button class="rounded bg-slate-200 text-slate-400">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                </div>
                                                <form @submit.prevent="deleteBarang(barang.id)">
                                                    <button type="submit" class="text-red-500 bg-red-200 rounded">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </template>
                </template>
            </tbody>
        </table>
    </div>
</template>