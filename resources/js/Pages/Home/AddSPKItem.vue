<script setup>
import { ref } from 'vue';
import AutoCompleteAPI from '../Shared/AutoCompleteAPI.vue';
import { debounce, isEmpty } from 'lodash';

const props = defineProps({
    keySPKItem: Number
});
const parametersToAssign = ['id', 'name'];
const emits = defineEmits(['chosenSPKItem', 'removeSPKItem']);

const jumlahItem = ref(0);
const chosenSPKItem = ref({});

function chosenAutoCompleteItem(params) {
    // console.log(params);
    chosenSPKItem.value = {
        itemID: params.id,
        itemName: params.name,
        jumlahItem: jumlahItem.value,
        keterangan: keterangan.value,
        iSPKItem: props.keySPKItem
    } 
    // console.log(chosenSPKItem);
    emits('chosenSPKItem', chosenSPKItem.value);
}

function initializeItemSum() {
    if (isEmpty(chosenSPKItem.value)) {
        chosenSPKItem.value = {
            itemID: null,
            itemName: null,
            jumlahItem: jumlahItem.value,
            keterangan: keterangan.value,
            iSPKItem: props.keySPKItem
        }
    } else {
        chosenSPKItem.value = {
            itemID: chosenSPKItem.value.itemID,
            itemName: chosenSPKItem.value.itemName,
            jumlahItem: jumlahItem.value,
            keterangan: keterangan.value,
            iSPKItem: props.keySPKItem
        }
    }
    emits('chosenSPKItem', chosenSPKItem.value);
}

// Membungkus fungsi dengan debounce
const debouncedInitializeItemSum = debounce(initializeItemSum, 500);
const debouncedInitializeItemSum2 = debounce(initializeItemSum, 1000);

let showKeterangan = ref(false);
const keterangan = ref(null);
const keteranganTemp = ref(null);
let classBtnToggleKeterangan = ref('border rounded border-yellow-300 text-yellow-500 font-semibold');
function toggleKeterangan() {
    showKeterangan.value = !showKeterangan.value;
    if (!showKeterangan.value) {
        if (keterangan.value) {
            keteranganTemp.value = keterangan.value;
            keterangan.value = null;
        }
        classBtnToggleKeterangan.value = 'border rounded border-yellow-300 text-yellow-500 font-semibold';
    } else {
        if (keteranganTemp.value) {
            keterangan.value = keteranganTemp.value;
        }
        classBtnToggleKeterangan.value = 'border rounded border-yellow-300 text-yellow-500 bg-yellow-200 font-semibold';
    }

    debouncedInitializeItemSum2();
}

function removeSPKItem() {
    emits('removeSPKItem', props.keySPKItem);
}

</script>
<template>
    <tr>
        <td>
            <div class="flex items-center mt-1">
                <button type="button" :class="classBtnToggleKeterangan" @click="toggleKeterangan">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
                <div class="ml-2 w-full">
                    <AutoCompleteAPI apiName="search_products" placeholder="nama produk" @paramsToEmit="chosenAutoCompleteItem" :parametersToAssign="parametersToAssign" />
                    <div v-if="showKeterangan" class="mt-1">
                        <textarea v-model="keterangan" @input="() => debouncedInitializeItemSum2()" cols="30" rows="3" class="border-slate-300 rounded-lg text-xs p-1 placeholder:text-slate-400" placeholder="keterangan item..."></textarea>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="flex gap-1 justify-center items-center">
                <input type="number" v-model="jumlahItem" @input="(event) => debouncedInitializeItemSum()" min="1" step="1" class="border-slate-300 rounded-lg text-xs p-1 w-1/2">
                <button type="button" class="text-red-300" @click="removeSPKItem">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
            </div>
        </td>
    </tr>
</template>