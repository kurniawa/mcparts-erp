<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import AutoComplete from '../Shared/AutoComplete.vue';
import {formatCurrencyIDw100, formatNumberDecIDw100} from '../../../../public/js/functions.js';

const props = defineProps({
    label_suppliers: Object,
    label_barangs: Object
})

// console.log(props);
const form = useForm({
    supplier: {
        id: '',
        nama: '',
    },
    keterangan: '',
    barang: {
        id: '',
        nama: '',
        satuan_main: '',
        satuan_sub: '',
        jumlah_main: '',
        jumlah_sub: '',
        harga_main: '',
        harga_sub: '',
        harga_main_formatted: '',
        harga_sub_formatted: '',
        harga_total_main: '',
        harga_total_sub: '',
        harga_total_main_formatted: '',
        harga_total_sub_formatted: '',
    },
})
// console.log(date.getDay());
let show_date_picker = ref(false);
const toggleDatePicker = () => {
    show_date_picker.value = !show_date_picker.value;
    // console.log(show_date_picker.value);
}

watch(form, (value) => {
    // console.log(form.date);
    // value.day = value.date.getDate();
    // value.month = value.date.getMonth() + 1;
    // value.year = value.date.getFullYear();
    // console.log(value);
    // console.log(form);
});
// console.log(form);

function chooseSupplier (chosen) {
    // console.log("listened", chosen);
    // form.supplier.id = result.res.id;
    // form.supplier.nama = result.res.name;
    // console.log(form.result);
    form.supplier.id = chosen.res.id;
    form.supplier.nama = chosen.res.name;
    // console.log(form);
}

const chooseBarang = (chosen) => {
    console.log("listened", chosen);
    // console.log("i", i);
    try {
        // form.barang[result.index].id = result.res.id;
        // form.barang[result.index].nama = result.res.name;
        form.barang.id = chosen.res.id;
        form.barang.nama = chosen.res.name;
        form.barang.satuan_main = chosen.res.satuan_main;
        form.barang.satuan_sub = chosen.res.satuan_sub;
        form.barang.jumlah_main = chosen.res.jumlah_main;
        form.barang.jumlah_sub = chosen.res.jumlah_sub;
        form.barang.harga_main = chosen.res.harga_main;
        form.barang.harga_sub = chosen.res.harga_sub;
        form.barang.harga_total_main = chosen.res.harga_total_main;
        form.barang.harga_total_sub = chosen.res.harga_total_main * chosen.res.jumlah_sub;

        form.barang.jumlah_main_formatted = formatNumberDecIDw100(chosen.res.jumlah_main);
        form.barang.jumlah_sub_formatted = formatNumberDecIDw100(chosen.res.jumlah_sub);
        form.barang.harga_main_formatted = formatNumberDecIDw100(chosen.res.harga_main);
        form.barang.harga_total_main_formatted = formatNumberDecIDw100(chosen.res.harga_total_main);
        form.barang.harga_total_sub_formatted = formatNumberDecIDw100(form.barang.harga_total_sub);

        countHargaTotal();
    } catch (error) {
        console.log(error);
        // console.error(error);
    }
    // console.log(form.barang);
}

// let jumlah_item = ref(0);
// const add_item_element = () => {
//     jumlah_item.value++;
// }

// let list_item_pembelian = reactive([]);
const add_item_element = () => {
    form.barang.push({});
    // console.log(form.barang);

    // list_item_pembelian.push(form.barang[form.barang.length - 1]);
}

const changeJumlahMain = () => {
    form.barang.jumlah_main = form.barang.jumlah_main_formatted;
    form.barang.jumlah_main_formatted = formatNumberDecIDw100(form.barang.jumlah_main);
    // list_item_pembelian
    // console.log(form.barang);
    form.barang.harga_total_main = form.barang.harga_main * (form.barang.jumlah_sub) * (form.barang.jumlah_main);
    form.barang.harga_total_main_formatted = formatNumberDecIDw100(form.barang.harga_total_main);
    countHargaTotal();
}

const changeJumlahSub = () => {
    form.barang.jumlah_sub = form.barang.jumlah_sub_formatted;
    form.barang.jumlah_sub_formatted = formatNumberDecIDw100(form.barang.jumlah_sub);

    form.barang.harga_total_main = form.barang.harga_main * (form.barang.jumlah_sub) * (form.barang.jumlah_main);
    form.barang.harga_total_main_formatted = formatNumberDecIDw100(form.barang.harga_total_main);
    countHargaTotal();
}

const changeHargaMain = () => {
    form.barang.harga_main = form.barang.harga_main_formatted;
    form.barang.harga_main_formatted = formatNumberDecIDw100(form.barang.harga_main);

    form.barang.harga_total_main = form.barang.harga_main * (form.barang.jumlah_sub) * (form.barang.jumlah_main);
    form.barang.harga_total_main_formatted = formatNumberDecIDw100(form.barang.harga_total_main);
    countHargaTotal();
}

const countHargaTotal = () => {
    // console.log('countHargaTotal');
    form.barang.harga_total_sub = 0;
    let harga_total_main = (form.barang.jumlah_sub) * (form.barang.jumlah_main) * form.barang.harga_main
    form.barang.harga_total_sub += harga_total_main;
    form.barang.harga_total_sub_formatted = formatCurrencyIDw100(form.barang.harga_total_sub);
}

const addBarang = () => {
    const sure = confirm('Apakah data yang diinput sudah benar?');
    if (sure) {
        // console.log(form);
        form.post(route('barangs.store'));
    }
}

</script>

<template>
    <div class="flex justify-center">
        <form @submit.prevent="addBarang" class="border rounded border-indigo-300 p-1 mt-1 lg:w-3/5 md:w-3/4">
            <table class="text-xs w-full">
                <tbody>
                    <tr>
                        <td>Supplier</td><td><div class="mx-2">:</div></td>
                        <td class="py-1">
                            <AutoComplete :source="props.label_suppliers" :index="null" placeholder="nama supplier" @item="chooseSupplier"></AutoComplete>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama</td><td><div class="mx-2">:</div></td>
                        <td>
                            <AutoComplete :source="props.label_barangs" :index="null" placeholder="nama produk" @item="chooseBarang"></AutoComplete>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="my-5 border rounded p-1 border-sky-500">
                                <div class="my-2 font-semibold text-center">Satuan - Jumlah - Harga per Satuan - Harga Total:</div>
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td>Satuan Utama</td><td><div class="mx-1">:</div></td><td><input type="text" v-model="form.barang.satuan_main" class="text-xs rounded p-1 w-3/4"></td>
                                            <td>Jumlah</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" v-model="form.barang.jumlah_main" class="text-xs rounded p-1 w-3/4">
                                            </td>
                                            <td>Harga</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" v-model="form.barang.harga_main_formatted" class="text-xs rounded p-1">
                                                <input type="hidden" v-model="form.barang.harga_main">
                                            </td>
                                            <td>Harga Total</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" v-model="form.barang.harga_total_main_formatted" class="text-xs rounded p-1" onchange="formatNumber(this, 'barang_new-harga_total_main-real');copy_to_harga_sub();count_harga_total_sub()">
                                                <input type="hidden" v-model="form.barang.harga_total_main" id="barang_new-harga_total_main-real">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Satuan Sub</td><td><div class="mx-1">:</div></td><td><input type="text" v-model="form.barang.satuan_sub"class="text-xs rounded p-1 w-3/4"></td>
                                            <td>Jumlah</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" v-model="form.barang.jumlah_sub_formatted" class="text-xs rounded p-1 w-3/4">
                                            </td>
                                            <td>Harga</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" v-model="form.barang.harga_sub_formatted" class="text-xs rounded p-1" onchange="formatNumber(this, 'barang_new-harga_sub-real');count_harga_total_sub()">
                                                <input type="hidden" v-model="form.barang.harga_sub">
                                            </td>
                                            <td>Harga Total</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" v-model="form.barang.harga_total_sub_formatted"class="text-xs rounded p-1">
                                                <input type="hidden" v-model="form.barang.harga_total_sub">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td>Ket. (opt.)</td><td><div class="mx-2">:</div></td>
                        <td class="py-1"><textarea name="keterangan" id="" cols="40" rows="3" placeholder="keterangan..." class="rounded text-xs p-1"></textarea></td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center mt-3">
                <button type="submit" class="border-2 border-indigo-300 bg-indigo-200 text-indigo-600 rounded-lg font-semibold py-1 px-3 hover:bg-indigo-300">+ Tambah Produk</button>
            </div>
        </form>
    </div>
</template>