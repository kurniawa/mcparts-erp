<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import AutoComplete from '../Shared/AutoComplete.vue';

const props = defineProps({
    label_suppliers: Object,
    label_products: Object
})

console.log(props);
const form = useForm({
    supplier: {
        id: '',
        nama: '',
    },
    keterangan: '',
    product: {
        id: '',
        nama: '',
        satuan_main: '',
        satuan_sub: '',
        jumlah_main: '',
        jumlah_sub: '',
        harga_main: '',
        harga_sub: '',
        harga_total_main: '',
        harga_total_sub: '',
    },
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

const chooseProduct = (chosen) => {
    // console.log("listened", chosen);
    // console.log("i", i);
    try {
        // form.product[result.index].id = result.res.id;
        // form.product[result.index].nama = result.res.name;
        form.product.id = chosen.res.id;
        form.product.nama = chosen.res.name;
        form.product.satuan_main = chosen.res.satuan_main;
        form.product.satuan_sub = chosen.res.satuan_sub;
        form.product.jumlah_main = chosen.res.jumlah_main;
        form.product.jumlah_sub = chosen.res.jumlah_sub;
        form.product.harga_main = chosen.res.harga_main;
        form.product.harga_sub = chosen.res.harga_sub;
        form.product.harga_total_main = chosen.res.harga_total_main;

        form.product.jumlah_main_formatted = formatNumberDecIDw100(chosen.res.jumlah_main);
        form.product.jumlah_sub_formatted = formatNumberDecIDw100(chosen.res.jumlah_sub);
        form.product.harga_main_formatted = formatNumberDecIDw100(chosen.res.harga_main);
        form.product.harga_total_main_formatted = formatNumberDecIDw100(chosen.res.harga_total_main);

        countHargaTotal();
    } catch (error) {
        console.log(error);
        console.error(error);
    }
    // console.log(form.product);
}

// let jumlah_item = ref(0);
// const add_item_element = () => {
//     jumlah_item.value++;
// }

// let list_item_pembelian = reactive([]);
const add_item_element = () => {
    form.product.push({});
    // console.log(form.product);

    // list_item_pembelian.push(form.product[form.product.length - 1]);
}

const changeJumlahMain = (i) => {
    form.product[i].jumlah_main = form.product[i].jumlah_main_formatted;
    form.product[i].jumlah_main_formatted = formatNumberDecIDw100(form.product[i].jumlah_main);
    // list_item_pembelian
    // console.log(form.product[i]);
    form.product[i].harga_total_main = form.product[i].harga_main * (form.product[i].jumlah_sub) * (form.product[i].jumlah_main);
    form.product[i].harga_total_main_formatted = formatNumberDecIDw100(form.product[i].harga_total_main);
    countHargaTotal();
}

const changeJumlahSub = (i) => {
    form.product[i].jumlah_sub = form.product[i].jumlah_sub_formatted;
    form.product[i].jumlah_sub_formatted = formatNumberDecIDw100(form.product[i].jumlah_sub);

    form.product[i].harga_total_main = form.product[i].harga_main * (form.product[i].jumlah_sub) * (form.product[i].jumlah_main);
    form.product[i].harga_total_main_formatted = formatNumberDecIDw100(form.product[i].harga_total_main);
    countHargaTotal();
}

const changeHargaMain = (i) => {
    form.product[i].harga_main = form.product[i].harga_main_formatted;
    form.product[i].harga_main_formatted = formatNumberDecIDw100(form.product[i].harga_main);

    form.product[i].harga_total_main = form.product[i].harga_main * (form.product[i].jumlah_sub) * (form.product[i].jumlah_main);
    form.product[i].harga_total_main_formatted = formatNumberDecIDw100(form.product[i].harga_total_main);
    countHargaTotal();
}

const countHargaTotal = () => {
    // console.log('countHargaTotal');
    form.harga_total_all = 0;
    form.product.forEach(product => {
        let harga_total_main = (product.jumlah_sub) * (product.jumlah_main) * product.harga_main
        form.harga_total_all += harga_total_main;
    });
    form.harga_total_all_formatted = formatCurrencyIDw100(form.harga_total_all);
}

const addProduk = () => {
    const sure = confirm('Apakah data yang diinput sudah benar?');
    if (sure) {
        // console.log(form);
        form.post(route('produks.store'));
    }
}

</script>

<template>
    <div class="flex justify-center">
        <form @submit.prevent="addProduk" class="border rounded border-indigo-300 p-1 mt-1 lg:w-3/5 md:w-3/4">
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
                            <AutoComplete :source="props.label_products" :index="null" placeholder="nama produk" @item="chooseProduct"></AutoComplete>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="my-5 border rounded p-1 border-sky-500">
                                <div class="my-2 font-semibold text-center">Satuan - Jumlah - Harga per Satuan - Harga Total:</div>
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td>Satuan Utama</td><td><div class="mx-1">:</div></td><td><input type="text" v-model="form.product.satuan_main" class="text-xs rounded p-1 w-3/4"></td>
                                            <td>Jumlah</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" v-model="form.product.jumlah_main" class="text-xs rounded p-1 w-3/4" oninput="count_harga_total_main()">
                                            </td>
                                            <td>Harga</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" id="product_new-harga_main" class="text-xs rounded p-1" onchange="formatNumber(this, 'product_new-harga_main-real')">
                                                <input type="hidden" name="harga_main" id="product_new-harga_main-real">
                                            </td>
                                            <td>Harga Total</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" name="harga_total_main" id="product_new-harga_total_main" class="text-xs rounded p-1" onchange="formatNumber(this, 'product_new-harga_total_main-real');copy_to_harga_sub();count_harga_total_sub()">
                                                <input type="hidden" name="harga_total_main" id="product_new-harga_total_main-real">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Satuan Sub</td><td><div class="mx-1">:</div></td><td><input type="text" name="satuan_sub" class="text-xs rounded p-1 w-3/4"></td>
                                            <td>Jumlah</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" name="jumlah_sub" id="product_new-jumlah_sub" class="text-xs rounded p-1 w-3/4" oninput="count_harga_total_sub()">
                                            </td>
                                            <td>Harga</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" id="product_new-harga_sub" class="text-xs rounded p-1" onchange="formatNumber(this, 'product_new-harga_sub-real');count_harga_total_sub()">
                                                <input type="hidden" name="harga_sub" id="product_new-harga_sub-real">
                                            </td>
                                            <td>Harga Total</td><td><div class="mx-1">:</div></td>
                                            <td>
                                                <input type="text" name="harga_total_sub" id="product_new-harga_total_sub" class="text-xs rounded p-1" onchange="formatNumber(this, 'product_new-harga_total_sub-real');">
                                                <input type="hidden" name="harga_total_sub" id="product_new-harga_total_sub-real">
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