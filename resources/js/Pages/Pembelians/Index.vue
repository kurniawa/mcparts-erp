<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, reactive, ref, toRaw } from 'vue';
import Pembelians from './Pembelians.vue';
import AddPembelian from './AddPembelian.vue';

// const jumlah_hari = ref(32);
const date_now = new Date();
const day_now = date_now.getDay();
const month_now = date_now.getMonth();
const year_now = date_now.getFullYear();

// console.log(day_now);
// console.log(year_now);
const props = defineProps({
    session: Object,
    pembelians: Object,
    pembelian_barangs_all: Object,
    alamats: Object,
    grand_total: Number,
    lunas_total: Number,
    from: String,
    until: String,
    pembelian_total_suppliers: Object,
    label_suppliers: Object,
    label_barang: Object,
})
// console.log(props.from);
// console.log(new Date(props.from).toLocaleDateString("id-ID"));

// console.log(props.from.split(" "));

const form = useForm({});
const show_pembelian_items = reactive([]);

// console.log(show_pembelian_items);
onMounted(() => {
    props.pembelians.forEach((pembelian, index) => {
        show_pembelian_items[index] = 'opacity-0 ';
    });
    // console.log(show_pembelian_items);
    // console.log(show_pembelian_items[0]);
});

const showPembelianItems = (id) => {
    // console.log(show_pembelian_items);
    // console.log(toRaw(show_pembelian_items));
    // console.log(id);
    // console.log(show_pembelian_items);
    // console.log(show_pembelian_items[id]);
    if (show_pembelian_items[id] == 'opacity-0 ') {
        show_pembelian_items[id] = 'opacity-100 ';
    } else {
        show_pembelian_items[id] = 'opacity-0 ';
    }
    // console.log(show_pembelian_items);
    // console.log(show_pembelian_items[id]);

    // if (toRaw(show_pembelian_items)[id] == '') {
    //     set(show_pembelian_items, id, 'hidden');
    // } else {
    //     set(show_pembelian_items, id, '');
    // }
    // console.log(show_pembelian_items);
}



const submitBarangStore = () => {}
let show_add_pembelian = ref(false);
const toggleAddPembelian = () => {
    // console.log(show_add_pembelian);
    if (show_add_pembelian.value) {
        show_add_pembelian.value = false;
    } else {
        show_add_pembelian.value = true
    }
}
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Pembelian" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembelian</h2>
        </template>

        <div class="relative rounded mt-9">
        <div class="flex absolute -top-6 left-1/2 -translate-x-1/2 z-20">

        </div>
        <div class="relative bg-white border-t z-10">
            <div class="mx-1 py-1 sm:px-6 lg:px-8 text-xs">
                <!-- SEARCH / FILTER -->
                
                <!-- END - SEARCH / FILTER -->
                <div class="flex mt-2">
                    <button type="button" class="border rounded border-emerald-300 text-emerald-500 font-semibold px-3 py-1 ml-1" id="btn_new_pembelian" @click="toggleAddPembelian">+ Pembelian</button>
                    <button type="button" class="border rounded border-indigo-300 text-indigo-500 font-semibold px-3 py-1 ml-1" id="btn_new_barang" onclick="toggle_light(this.id, 'form_new_barang', [], ['bg-indigo-200'], 'block')">+ Barang</button>
                </div>
            </div>
            <!-- FORM_NEW_PEMBELIAN -->
             <!-- <div v-if="show_add_pembelian"> -->
                 <AddPembelian :label_suppliers="label_suppliers" :label_barang="label_barang"/>
             <!-- </div> -->
            <!-- END - FORM_NEW_PEMBELIAN -->
            <!-- FORM_NEW_BARANG -->
            <div id="form_new_barang" class="hidden">
                <div class="flex justify-center">
                    <form @submit.prevent="submitBarangStore" class="border rounded border-indigo-300 p-1 mt-1 lg:w-3/5 md:w-3/4">
                        <table class="text-xs w-full">
                            <tbody>
                                <tr>
                                    <td>Supplier</td><td><div class="mx-2">:</div></td>
                                    <td class="py-1">
                                        <input type="text" name="supplier_nama" id="barang_new-supplier_nama" placeholder="nama supplier..." class="text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                        <input type="hidden" name="supplier_id" id="barang_new-supplier_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama</td><td><div class="mx-2">:</div></td>
                                    <td>
                                        <input type="text" name="barang_nama" id="barang_new-barang_nama" placeholder="nama barang ..." class="w-full text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                        <input type="hidden" name="barang_id" id="barang_new-barang_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="my-5 border rounded p-1 border-sky-500">
                                            <div class="my-2 font-semibold text-center">Satuan - Jumlah - Harga per Satuan - Harga Total:</div>
                                            <table class="w-full">
                                                <tbody>
                                                    <tr>
                                                        <td>Satuan Utama</td><td><div class="mx-1">:</div></td><td><input type="text" name="satuan_main" class="text-xs rounded p-1 w-3/4"></td>
                                                        <td>Jumlah</td><td><div class="mx-1">:</div></td>
                                                        <td>
                                                            <input type="text" name="jumlah_main" id="barang_new-jumlah_main" class="text-xs rounded p-1 w-3/4" oninput="count_harga_total_main()">
                                                        </td>
                                                        <td>Harga</td><td><div class="mx-1">:</div></td>
                                                        <td>
                                                            <input type="text" id="barang_new-harga_main" class="text-xs rounded p-1" onchange="formatNumber(this, 'barang_new-harga_main-real')">
                                                            <input type="hidden" name="harga_main" id="barang_new-harga_main-real">
                                                        </td>
                                                        <td>Harga Total</td><td><div class="mx-1">:</div></td>
                                                        <td>
                                                            <input type="text" name="harga_total_main" id="barang_new-harga_total_main" class="text-xs rounded p-1" onchange="formatNumber(this, 'barang_new-harga_total_main-real');copy_to_harga_sub();count_harga_total_sub()">
                                                            <input type="hidden" name="harga_total_main" id="barang_new-harga_total_main-real">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Satuan Sub</td><td><div class="mx-1">:</div></td><td><input type="text" name="satuan_sub" class="text-xs rounded p-1 w-3/4"></td>
                                                        <td>Jumlah</td><td><div class="mx-1">:</div></td>
                                                        <td>
                                                            <input type="text" name="jumlah_sub" id="barang_new-jumlah_sub" class="text-xs rounded p-1 w-3/4" oninput="count_harga_total_sub()">
                                                        </td>
                                                        <td>Harga</td><td><div class="mx-1">:</div></td>
                                                        <td>
                                                            <input type="text" id="barang_new-harga_sub" class="text-xs rounded p-1" onchange="formatNumber(this, 'barang_new-harga_sub-real');count_harga_total_sub()">
                                                            <input type="hidden" name="harga_sub" id="barang_new-harga_sub-real">
                                                        </td>
                                                        <td>Harga Total</td><td><div class="mx-1">:</div></td>
                                                        <td>
                                                            <input type="text" name="harga_total_sub" id="barang_new-harga_total_sub" class="text-xs rounded p-1" onchange="formatNumber(this, 'barang_new-harga_total_sub-real');">
                                                            <input type="hidden" name="harga_total_sub" id="barang_new-harga_total_sub-real">
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
                            <button type="submit" class="border-2 border-indigo-300 bg-indigo-200 text-indigo-600 rounded-lg font-semibold py-1 px-3 hover:bg-indigo-300">+ Barang</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END - FORM_NEW_BARANG -->
            <div class="grid">
                <div class="tabs tabs-lifted z-10 -mb-[var(--tab-border)] justify-self-start">
                    <button class="tab tab-active [--tab-bg:var(--fallback-b1,oklch(var(--b1)]"><!---->Preview<!----></button>
                    <button class="tab [--tab-border-color:transparent]">HTML</button>
                    <button class="tab [--tab-border-color:transparent]">JSX</button>
                    <div class="tab [--tab-border-color:transparent]"></div>
                </div>
                <div class="bg-base-300 rounded-b-box rounded-se-box relative overflow-x-auto">
                    <div class="preview border-base-300 bg-base-100 rounded-b-box rounded-se-box flex min-h-[6rem] min-w-[18rem] max-w-4xl flex-wrap items-center justify-center gap-2 overflow-x-hidden bg-cover bg-top p-4 [border-width:var(--tab-border)]" style="">
                        <div class="drawer h-56 rounded overflow-hidden">
                            <input id="my-drawer" type="checkbox" class="drawer-toggle"> 
                            <div class="flex flex-col items-center justify-center drawer-content">
                                <label for="my-drawer" class="btn btn-primary drawer-button">Open drawer</label>
                            </div> <div class="drawer-side h-full absolute">
                                <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label> 
                                <ul class="menu p-4 w-60 md:w-80 min-h-full bg-base-200 text-base-content">
                                    <li><button>Sidebar Item 1</button></li> 
                                    <li><button>Sidebar Item 2</button></li>
                                </ul>
                            </div>
                        </div><!---->
                    </div>
                </div><!----> <!----> <!---->
            </div>

            <div class="collapse bg-base-200">
                <input type="checkbox" />
                <div class="collapse-title text-xl font-medium">Click me to show/hide content</div>
                <div class="collapse-content">
                    <p>hello</p>
                </div>
            </div>
            
            <Pembelians :pembelians="pembelians" :pembelian_barangs_all="pembelian_barangs_all" :alamats="alamats" :grand_total="grand_total" :lunas_total="lunas_total" :from="from" :until="until"></Pembelians>

            <!-- PRINT_OUT -->
            <div class="hidden">
                <div class="text-center mt-5">Preview: Print Out</div>
                <div class="flex justify-center">
                    <div class="border rounded p-2">
                        <table id="pembelian-to-excel">
                            <thead>
                                <tr>
                                    <th></th><th></th><th></th><th></th><th></th><th></th><th>belum lunas</th><th>sudah lunas</th><th>grand total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td>{{ grand_total - lunas_total }}</td><td>{{ lunas_total }}</td><td>{{ grand_total }}</td></tr>
                                <tr>
                                    <th>tanggal</th><th>supplier</th><th>nomor nota</th><th>nama barang</th><th>keterangan</th><th>jumlah sub</th><th>jumlah main</th><th>harga</th><th>harga total</th>
                                </tr>
                                <template v-for="(pembelian, index) in pembelians">
                                <tr v-for="(pembelian_barang, i_pembelian_barang) in pembelian_barangs_all[index]" class="border-b">
                                    <!-- <td>{{ date('d-m-Y',strtotime(pembelian.created_at }}</td> -->
                                    <td>{{ pembelian.created_at }}</td>
                                    <td v-if="alamats[index]">{{ pembelian.supplier_nama }} - {{ alamats[index].short }}</td>
                                    <td v-else>{{ pembelian.supplier_nama }}</td>
                                    <td>{{ pembelian.nomor_nota }}</td>
                                    <td>{{ pembelian_barang.barang_nama }}</td>
                                    <td>{{ pembelian.keterangan_bayar }}</td>
                                    <td>{{ pembelian_barang.jumlah_sub / 100 }} {{ pembelian_barang.satuan_sub }}</td>
                                    <td>{{ pembelian_barang.jumlah_main / 100 }} {{ pembelian_barang.satuan_main }}</td>
                                    <td>{{ pembelian_barang.harga_main }}</td>
                                    <td>{{ pembelian_barang.harga_t }}</td>
                                </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
                // END - PRINT_OUT
            </div>
            <div class="w-56"></div>
        </div>
    </div>

    </AuthenticatedLayout>
</template>
