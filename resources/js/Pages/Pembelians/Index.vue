<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, reactive, ref, toRaw } from 'vue';
import Pembelians from './Pembelians.vue';
import AddPembelian from './AddPembelian.vue';
import Tab from '../Shared/Tab.vue';

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
let class_for_btn_add_pembelian = ref('border rounded border-emerald-300 text-emerald-500 font-semibold px-3 py-1 ml-1');
const toggleAddPembelian = () => {
    // console.log(show_add_pembelian);
    if (show_add_pembelian.value) {
        show_add_pembelian.value = false;
        class_for_btn_add_pembelian.value = 'border rounded border-emerald-300 text-emerald-500 font-semibold px-3 py-1';
    } else {
        show_add_pembelian.value = true;
        class_for_btn_add_pembelian.value = 'border rounded border-emerald-300 text-emerald-500 bg-emerald-200 font-semibold px-3 py-1';
    }
}

</script>
<template>
    <AuthenticatedLayout>
        <Head title="Pembelian" />
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembelian</h2>
        </template> -->

        <div class="relative rounded">
            <Tab :tabs="['pembelians.index', 'produks.index']" :titles="['Pembelian', 'Barang']">
                <div class="relative bg-white border-t z-10">
                    <div class="">
                        <!-- SEARCH / FILTER -->
                        
                        <!-- END - SEARCH / FILTER -->
                        <div class="flex mt-2 text-xs ml-2">
                            <button type="button" :class="class_for_btn_add_pembelian" @click="toggleAddPembelian">+ Tambah Pembelian</button>
                        </div>
                    </div>
                    <!-- FORM_NEW_PEMBELIAN -->
                     <div v-if="show_add_pembelian">
                         <AddPembelian :label_suppliers="label_suppliers" :label_barang="label_barang"/>
                     </div>
                    <!-- END - FORM_NEW_PEMBELIAN -->
        
                    <!-- <div class="collapse bg-base-200">
                        <input type="checkbox" />
                        <div class="collapse-title text-xl font-medium">Click me to show/hide content</div>
                        <div class="collapse-content">
                            <p>hello</p>
                        </div>
                    </div> -->
                    
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
                                            <td>{{ pembelian_barang.jumlah_sub }} {{ pembelian_barang.satuan_sub }}</td>
                                            <td>{{ pembelian_barang.jumlah_main }} {{ pembelian_barang.satuan_main }}</td>
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
            </Tab>
        </div>

    </AuthenticatedLayout>
</template>
