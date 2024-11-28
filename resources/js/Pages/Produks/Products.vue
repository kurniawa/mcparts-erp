<script setup>
import { useForm } from '@inertiajs/vue3';
import {formatCurrencyIDw100, formatNumberDecIDw100} from '../../../../public/js/functions.js'
const props = defineProps({
    types: Object,
    products: Object,
    prices: Object,
});

console.log(props);
const form = useForm({});

const deleteProduct = (id) => {
    const sure = confirm('Anda yakin ingin hapus pembelian ini?');
    if (sure) {
        form.post(route('pembelians.delete',id));
    }
}

</script>
<template>
    <div class="flex justify-center mt-1">
        <div class='pb-1 text-xs lg:w-1/2 md:w-3/4'>
            <div class="flex">
                <button id="btn_all" class="btn-tipe border border-violet-300 text-violet-500 px-1 rounded ml-1">all</button>
                <button v-for="(type, i) in props.types" class="btn-tipe border border-violet-300 text-violet-500 px-1 rounded ml-1">{{ type.initial }}</button>
            </div>

            <!-- TABLE PRODUKS -->
            <table v-for="(type, i_type) in props.types" class="produk-tipe table-nice w-full mt-1">
                <tbody>
                    <tr>
                        <td class="font-bold">{{ type.tipe }}</td>
                    </tr>
                    <tr v-for="(product, i_product) in props.products[i_type]" class="border-b">
                        <td>
                            <a :href="route('produks.show', product.id)" class="text-sky-500">
                                <div class="min-w-max">
                                    {{ product.nama }}
                                </div>
                            </a>
                        </td>
                        <td>
                            <a v-if="product.supplier_id" :href="route('suppliers.show', product.supplier_id)" class="text-indigo-500">{{ product.supplier_nama }}</a>
                            <span v-else-if="product.supplier_nama">{{ product.supplier_nama }}</span>
                            <span v-else>--</span>
                        </td>
                        <td>
                            <div v-if="props.prices[i_type][i_product]" class="flex justify-between font-semibold">
                                <span>Rp</span>
                                {{ formatCurrencyIDw100(props.prices[i_type][i_product].harga) }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- END - TABLE PRODUKS -->
        </div>
    </div>
</template>