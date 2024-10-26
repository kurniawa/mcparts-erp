<script setup>
import { useForm } from '@inertiajs/vue3';
import { DatePicker } from 'v-calendar';
import { reactive, ref, watch } from 'vue';
import AutoComplete from '../Shared/AutoComplete.vue';
import {formatNumberDecID, formatCurrencyID} from '../../../../public/js/functions.js'

const props = defineProps({
    label_suppliers: Object,
    label_barang: Object
});
// console.log(props.label_suppliers);
// console.log(props.label_barang);

const date = new Date();
const form = useForm({
    date: date,
    day: date.getDate(),
    month: date.getMonth() + 1,
    year: date.getFullYear(),
    supplier: {
        id: '',
        nama: '',
    },
    keterangan: '',
    barang: [],
    harga_total_all: 0,
    harga_total_all_formatted: 0,
    nomor_nota: '',
})
// console.log(date.getDay());
let show_date_picker = ref(false);
const toggleDatePicker = () => {
    show_date_picker.value = !show_date_picker.value;
    // console.log(show_date_picker.value);
}

watch(form, (value) => {
    // console.log(form.date);
    // form.day = form.date.getDate();
    // form.month = form.date.getMonth() + 1;
    // form.year = form.date.getFullYear();
    // console.log(value);
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

const chooseItem = (chosen) => {
    // console.log("listened", chosen);
    // console.log("i", i);
    try {
        // form.barang[result.index].id = result.res.id;
        // form.barang[result.index].nama = result.res.name;
        form.barang[chosen.index].id = chosen.res.id;
        form.barang[chosen.index].nama = chosen.res.name;
        form.barang[chosen.index].satuan_main = chosen.res.satuan_main;
        form.barang[chosen.index].satuan_sub = chosen.res.satuan_sub;
        form.barang[chosen.index].jumlah_main = chosen.res.jumlah_main;
        form.barang[chosen.index].jumlah_sub = chosen.res.jumlah_sub;
        form.barang[chosen.index].harga_main = chosen.res.harga_main;
        form.barang[chosen.index].harga_sub = chosen.res.harga_sub;
        form.barang[chosen.index].harga_total_main = chosen.res.harga_total_main;

        form.barang[chosen.index].jumlah_main_formatted = formatNumberDecID(chosen.res.jumlah_main);
        form.barang[chosen.index].jumlah_sub_formatted = formatNumberDecID(chosen.res.jumlah_sub);
        form.barang[chosen.index].harga_main_formatted = formatNumberDecID(chosen.res.harga_main);
        form.barang[chosen.index].harga_total_main_formatted = formatNumberDecID(chosen.res.harga_total_main);

        countHargaTotal();
    } catch (error) {
        console.log(error);
        console.error(error);
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

const changeJumlahMain = (i) => {
    form.barang[i].jumlah_main = form.barang[i].jumlah_main_formatted * 100;
    form.barang[i].jumlah_main_formatted = formatNumberDecID(form.barang[i].jumlah_main);
    // list_item_pembelian
    // console.log(form.barang[i]);
    form.barang[i].harga_total_main = form.barang[i].harga_main * (form.barang[i].jumlah_sub / 100) * (form.barang[i].jumlah_main / 100);
    form.barang[i].harga_total_main_formatted = formatNumberDecID(form.barang[i].harga_total_main);
    countHargaTotal();
}

const changeJumlahSub = (i) => {
    form.barang[i].jumlah_sub = form.barang[i].jumlah_sub_formatted * 100;
    form.barang[i].jumlah_sub_formatted = formatNumberDecID(form.barang[i].jumlah_sub);

    form.barang[i].harga_total_main = form.barang[i].harga_main * (form.barang[i].jumlah_sub / 100) * (form.barang[i].jumlah_main / 100);
    form.barang[i].harga_total_main_formatted = formatNumberDecID(form.barang[i].harga_total_main);
    countHargaTotal();
}

const changeHargaMain = (i) => {
    form.barang[i].harga_main = form.barang[i].harga_main_formatted * 100;
    form.barang[i].harga_main_formatted = formatNumberDecID(form.barang[i].harga_main);

    form.barang[i].harga_total_main = form.barang[i].harga_main * (form.barang[i].jumlah_sub / 100) * (form.barang[i].jumlah_main / 100);
    form.barang[i].harga_total_main_formatted = formatNumberDecID(form.barang[i].harga_total_main);
    countHargaTotal();
}

const countHargaTotal = () => {
    // console.log('countHargaTotal');
    form.harga_total_all = 0;
    form.barang.forEach(barang => {
        let harga_total_main = (barang.jumlah_sub / 100) * (barang.jumlah_main / 100) * barang.harga_main
        form.harga_total_all += harga_total_main;
    });
    form.harga_total_all_formatted = formatCurrencyID(form.harga_total_all);
}

const submitAddPembelian = () => {
    const sure = confirm('Apakah data yang diinput sudah benar?');
    if (sure) {
        // console.log(form);
        form.post(route('pembelians.store'));
    }
}

</script>
<template>
    <div class="flex justify-center text-xs">
        <form @submit.prevent="submitAddPembelian" class="border rounded border-emerald-300 p-1 mt-1 lg:w-3/5 md:w-3/4">
            <div class="border rounded p-2">
                <div class="border-b pb-3">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nomor</td><td><div class="mx-2">:</div></td><td><input type="text" v-model="form.nomor_nota" class="rounded p-1 text-xs" placeholder="nomor nota ..."></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td><td><div class="mx-2">:</div></td>
                                <td class="py-1">
                                    <!-- <div class="flex">
                                        <select v-model="form.day" class="select">
                                            <template v-for="index in 31" :key="index">
                                                <option :value="index">{{ index }}</option>
                                            </template>
                                        </select>
                                        <select v-model="form.month" class="select">
                                            <template v-for="index in 12" :key="index">
                                                <option :value="index">{{ index }}</option>
                                            </template>
                                        </select>
                                        <input type="text" name="month" id="month" class="border rounded text-xs p-1 w-8 ml-1" placeholder="mm" value="{{ date('m') }}">
                                        <input type="text" name="year" id="year" class="border rounded text-xs p-1 w-11 ml-1" placeholder="yyyy" value="{{ date('Y') }}">
                                    </div> -->
                                    <div @click="toggleDatePicker" class="border p-2 flex justify-between items-center">
                                        <span>{{ form.day }}-{{ form.month }}-{{ form.year }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                        </svg>
                                    </div>
                                    <div v-show="show_date_picker">
                                        <DatePicker v-model="form.date" mode="date"></DatePicker>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Supplier</td><td><div class="mx-2">:</div></td>
                                <td class="py-1">
                                    <AutoComplete :source="props.label_suppliers" :index="null" @item="chooseSupplier"></AutoComplete>
                                </td>
                            </tr>
                            <tr class="align-top">
                                <td>Ket. (opt.)</td><td><div class="mx-2">:</div></td>
                                <td class="py-1">
                                    <textarea v-model="form.keterangan" cols="30" rows="5" class="border rounded p-1 text-xs" placeholder="keterangan (opt.)"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    <table id="table_pembelian_items" class="text-slate-500 w-full">
                        <thead>
                            <tr><th>Nama Item</th><th>Jml. Sub</th><th>Jml. Main</th><th>Hrg.</th><th>Hrg. t</th><th></th></tr>
                        </thead>
                        <tbody>
                            <tr id="tr_add_item">
                                <td>
                                    <button type="button" class="rounded bg-emerald-200 text-emerald-600" @click="add_item_element">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr v-for="(barang,i) in form.barang">
                                <td>
                                    <div class="flex items-center mt-1">
                                        <button id="toggle_barang_keterangan-${index_item}" type="button" class="border border-yellow-500 rounded text-yellow-500" onclick="toggle_light(this.id,'barang_keterangan-${index_item}', [], ['bg-yellow-300'], 'block')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                        <AutoComplete :source="label_barang" :index="i" @item="chooseItem"></AutoComplete>
                                        <!-- <input type="text" v-model="form.barang[i].nama" class="border-slate-300 rounded-lg text-xs p-1 ml-1 placeholder:text-slate-400 w-56" placeholder="nama item...">
                                        <input type="hidden" v-model="form.barang[i].id"> -->
                                    </div>
                                    <div class="mt-1 hidden">
                                        <textarea v-model="form.barang[i].keterangan" cols="30" rows="3" class="border-slate-300 rounded-lg text-xs p-0 placeholder:text-slate-400" placeholder="keterangan item..."></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <div class="flex items-center">
                                            <input type="text" v-model="form.barang[i].jumlah_sub_formatted" @change="changeJumlahSub(i)" class="border-slate-300 rounded-lg text-xs p-1 w-1/2">
                                            <input type="hidden" v-model="form.barang[i].jumlah_sub">
                                            <span class="ml-1">{{ form.barang[i].satuan_sub }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <div class="flex items-center">
                                            <input type="text" v-model="form.barang[i].jumlah_main_formatted" @change="changeJumlahMain(i)" min="1" step="1" class="border-slate-300 rounded-lg text-xs p-1 w-1/2">
                                            <input type="hidden" v-model="form.barang[i].jumlah_main">
                                            <span>{{ form.barang[i].satuan_main }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <div class="flex items-center">
                                            <input type="text" v-model="form.barang[i].harga_main_formatted" @change="changeHargaMain(i)" class="border-slate-300 rounded-lg text-xs p-1 w-3/4">/<span>{{ form.barang[i].satuan_main }}</span>
                                            <input type="hidden" v-model="form.barang[i].harga_main">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <div class="flex">
                                            <input type="text" v-model="form.barang[i].harga_total_main_formatted" class="border-slate-300 rounded-lg text-xs p-1 w-full">
                                            <input type="hidden" v-model="form.barang[i].harga_total_main">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="text-red-500" onclick="remove_item(${index_item})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-end items-center">
                        <span class="font-bold">Total</span>
                        <div class="flex font-bold ml-2 items-center text-pink-500">
                            <span>Rp</span>
                            <input type="text" v-model="form.harga_total_all_formatted" class="border-none p-1 w-28 ml-2">
                            <input type="hidden" v-model="form.harga_total_all">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-3">
                <button type="submit" class="border-2 border-emerald-300 bg-emerald-200 text-emerald-600 rounded-lg font-semibold py-1 px-3 hover:bg-emerald-300">Proses/Konfirmasi</button>
            </div>
        </form>
    </div>
</template>