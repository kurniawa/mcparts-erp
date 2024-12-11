<script setup>
import { useForm } from '@inertiajs/vue3';
import SimpleDatePicker from '../Shared/SimpleDatePicker.vue';
import AutoComplete from '../Shared/AutoComplete.vue';
import AddSPKItem from './AddSPKItem.vue';
import { ref, watch } from 'vue';
import { isEmpty } from 'lodash';

const props = defineProps({
    label_pelanggans: {type: Object},
});

// console.log(props.label_pelanggans);
const date = new Date();
const form = useForm({
    day: date.getDate(),
    month: date.getMonth() + 1,
    year: date.getFullYear(),
    use_date: true,
    keterangan: null,
    pelanggan: {
        id: null,
        nama: null,
    },
    reseller: {
        id: null,
    },
    SPKItems: []
});

// console.log(form.errors);
// console.log(isEmpty(form.errors));

watch(form, (value) => {
    // console.log(value.errors);
});

function emitDate(chosen_date) {
    // console.log(chosen_date)
    if (chosen_date.use_date) {
        form.day = chosen_date.value.getDate();
        form.month = chosen_date.value.getMonth() + 1;
        form.year = chosen_date.value.getFullYear();
    }
    form.use_date = chosen_date.use_date; // Menentukan apakah perlu menggunakan tanggal atau tidak
}

function chooseCustomer (chosen) {
    // console.log("listened", chosen);
    // form.supplier.id = result.res.id;
    // form.supplier.nama = result.res.name;
    // console.log(form.result);
    form.pelanggan.id = chosen.res.id;
    form.pelanggan.nama = chosen.res.name;
    if (chosen.res.reseller_id) {
        form.reseller.id = chosen.res.reseller_id;
    } else {
        form.reseller.id = null;
    }
    // console.log(form);
}

// let containerSPKItems = ref([])
let idContainerSPKItem = ref(0)
function add_SPK_Item() {
    // containerSPKItems.value.push({id:idContainerSPKItem.value});
    form.SPKItems.push({
        componentID:idContainerSPKItem.value,
        itemID: null,
        itemName: null,
        jumlahItem: null,
        keterangan: null,
    });
    idContainerSPKItem.value++;
    // console.log(containerSPKItems.value);
}

function onChosenSPKItem(chosenSPKItem) {
    const indexToUpdate = form.SPKItems.findIndex(SPKItem => SPKItem.componentID === chosenSPKItem.iSPKItem);
    form.SPKItems[indexToUpdate].itemID = chosenSPKItem.itemID;
    form.SPKItems[indexToUpdate].itemName = chosenSPKItem.itemName;
    form.SPKItems[indexToUpdate].jumlahItem = chosenSPKItem.jumlahItem;
    form.SPKItems[indexToUpdate].keterangan = chosenSPKItem.keterangan;
    // console.log(form.SPKItems);
}

function onRemoveSPKItem(index) {
    // console.log(index)
    // console.log(containerSPKItems);
    const indexToRemove = form.SPKItems.findIndex(SPKItem => SPKItem.componentID === index);
    form.SPKItems.splice(indexToRemove, 1);
    // containerSPKItems.value.splice(index, 1);
    // console.log(form.SPKItems);
    // console.log(containerSPKItems);
}

function storeSPK() {
    form.post(route('spks.store'));
}

</script>

<template>
    <div id="form_new_spk" class="ml-2 w-full bg-white rounded-lg text-xs">
        <div class="flex">
            <form @submit.prevent="storeSPK" class="w-full">
                <div class="border rounded p-2">
                    <div class="border-b pb-3">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Tanggal</td><td><div class="mx-2">:</div></td>
                                    <td class="py-1">
                                        <SimpleDatePicker :day="form.day" :month="form.month" :year="form.year" @chosen_date="emitDate"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Untuk</td><td><div class="mx-2">:</div></td>
                                    <td class="py-1">
                                        <AutoComplete :source="props.label_pelanggans" :index="null" @item="chooseCustomer" placeholder="nama pelanggan"></AutoComplete>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ket. (opt.)</td><td><div class="mx-2">:</div></td>
                                    <td class="py-1"><input type="text" v-model="form.keterangan" placeholder="judul/keterangan..." class="text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <table id="table_spk_items" class="text-slate-500 w-full">
                            <thead>
                                <tr><th>Nama Item</th><th>Jumlah</th></tr>
                            </thead>
                            <tbody>
                                <template v-for="(containerSPKItem) in form.SPKItems" :key="containerSPKItem.componentID">
                                    <AddSPKItem :keySPKItem="containerSPKItem.componentID" @chosenSPKItem="onChosenSPKItem" @removeSPKItem="onRemoveSPKItem"/>
                                </template>
                                <tr>
                                    <td>
                                        <button type="button" class="rounded bg-emerald-200 text-emerald-600" @click="add_SPK_Item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-2 flex" v-if="!isEmpty(form.errors)">
                    <div class="bg-red-200 border-2 border-red-500 rounded p-1">
                        <span class="font-bold">Errors:</span>
                        <div>{{ form.errors }}</div>
                    </div>
                </div>
                <div class="flex justify-center mt-3">
                    <button type="submit" class="border-2 border-emerald-300 bg-emerald-200 text-emerald-600 rounded-lg font-semibold py-1 px-3 hover:bg-emerald-300">proses new SPK</button>
                </div>
            </form>
        </div>
    </div>
</template>