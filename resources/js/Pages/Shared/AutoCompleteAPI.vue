<script setup>
import { debounce } from 'lodash';
import { ref, watch, defineEmits } from 'vue';

const props = defineProps({
    apiName: {type: String},
    placeholder: {type: String},
});
let search_results = ref([]);
let key_name = ref('');
let key_id = ref('');
let show_results = ref(false);
let isSelecting = ref(false);

const emits = defineEmits(['paramsToEmit']);

watch(
    key_name,
    debounce(async (value) => {
        if (isSelecting.value) {
            // Abaikan watch jika sedang memilih item
            isSelecting.value = false;
            return;
        }
        if (!value) {
            search_results.value = [];
            show_results.value = false;
            emits('paramsToEmit', {
                itemID: null, 
                itemName: null,
            });
            return;
        }
        try {
            const response = await fetch(`/api/${props.apiName}?key_name=${encodeURIComponent(value)}`);
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            } else {
                search_results.value = await response.json();
                show_results.value = true;
                // console.log(search_results);
            }

        } catch (error) {
            console.error('Error fetching search results:', error);
            search_results.value = [];
            show_results.value = false;
        }
    }, 500)
);

function chooseItem (item) {
    // console.log('chosen', item);
    key_name.value = item.name;
    key_id.value = item.id;
    show_results.value = false;
    isSelecting.value = true; // Atur flag untuk menghentikan watch sementara
    const paramsToEmit = {
        'itemID': item.id,
        'itemName': item.name,
    };
    emits('paramsToEmit', paramsToEmit);
}
</script>
<template>
    <div class="relative w-full">
        <input type="text" v-model="key_name" :placeholder="placeholder" class="text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-full placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
        <input type="hidden" v-model="key_id">
        <ul v-if="show_results && search_results.length" class="absolute bg-white shadow-lg border rounded w-full z-10">
            <li v-for="item in search_results" :key="item.id" @click="chooseItem(item)" class="p-2 hover:bg-gray-100 cursor-pointer">
                {{ item.name }}
            </li>
        </ul>
    </div>
</template>