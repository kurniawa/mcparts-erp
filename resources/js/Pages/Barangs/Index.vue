<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, reactive, ref, toRaw } from 'vue';
import Tab from '../Shared/Tab.vue';
import AddBarang from './AddBarang.vue';
import Barangs from './Barangs.vue';

// const jumlah_hari = ref(32);
const date_now = new Date();
const day_now = date_now.getDay();
const month_now = date_now.getMonth();
const year_now = date_now.getFullYear();

// console.log(day_now);
// console.log(year_now);
const props = defineProps({
    session: Object,
    suppliers: Object,
    barangs: Object,
    hargas: Object,
    label_suppliers: Object,
    label_barangs: Object,
})
// console.log(props.from);
// console.log(new Date(props.from).toLocaleDateString("id-ID"));

// console.log(props.from.split(" "));

const form = useForm({});

// // console.log(show_pembelian_items);
// onMounted(() => {
//     props.barangs.forEach((produk, index) => {
//         show_produk_items[index] = 'opacity-0 ';
//     });
//     // console.log(show_pembelian_items);
//     // console.log(show_pembelian_items[0]);
// });

const submitBarangStore = () => {}
let show_add_barang = ref(false);
let class_for_btn_add_produk = ref('border rounded border-indigo-300 text-indigo-500 font-semibold px-3 py-1');
const toggleAddPembelian = () => {
    // console.log(show_add_barang);
    if (show_add_barang.value) {
        show_add_barang.value = false;
        class_for_btn_add_produk.value = 'border rounded border-indigo-300 text-indigo-500 font-semibold px-3 py-1';
    } else {
        show_add_barang.value = true;
        class_for_btn_add_produk.value = 'border rounded border-indigo-300 text-indigo-500 bg-indigo-200 font-semibold px-3 py-1';
    }
}

</script>
<template>
    <AuthenticatedLayout>
        <Head title="Produk" />
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembelian</h2>
        </template> -->

        <div class="relative rounded">
            <Tab :tabs="['pembelians.index', 'barangs.index']" :titles="['Pembelian', 'Barang']">
                <div class="relative bg-white border-t z-10">
                    <div class="">
                        <!-- SEARCH / FILTER -->
                        
                        <!-- END - SEARCH / FILTER -->
                        <div class="flex mt-2 text-xs ml-3">
                            <button type="button" :class="class_for_btn_add_produk" @click="toggleAddPembelian">+ Tambah Barang</button>
                        </div>
                    </div>
                    <!-- FORM_NEW_BARANG -->
                     <div v-if="show_add_barang">
                         <AddBarang :label_suppliers="label_suppliers" :label_barangs="label_barangs"/>
                     </div>
                    <!-- END - FORM_NEW_BARANG -->
                     <Barangs :barangs="barangs" :suppliers="suppliers" />
                    
                    <!-- <Pembelians :pembelians="pembelians" :pembelian_barangs_all="pembelian_barangs_all" :alamats="alamats" :grand_total="grand_total" :lunas_total="lunas_total" :from="from" :until="until"></Pembelians> -->
        
                    <div class="w-56"></div>
                </div>
            </Tab>
        </div>

    </AuthenticatedLayout>
</template>
