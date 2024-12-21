<script setup>
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const props = defineProps({
    apiName: {type: String},
    placeholder: {type: String},
    parametersToAssign: {type: Array}
});

let search_results = ref([]);
let search_key = ref('');
let key_id = ref('');
let show_results = ref(false);
let isSelecting = ref(false);
const highlightedIndex = ref(-1);

const emits = defineEmits(['paramsToEmit']);
const paramsToEmit = ref({});
props.parametersToAssign.forEach(param => {
    paramsToEmit.value[param] = null;
});
// console.log(props.parametersToAssign);
// console.log(paramsToEmit.value);

watch(
    search_key,
    debounce(async (value) => {
        if (isSelecting.value) {
            // Abaikan watch jika sedang memilih item
            isSelecting.value = false;
            return;
        }
        if (!value) {
            search_results.value = [];
            show_results.value = false;
            props.parametersToAssign.forEach(param => {
                paramsToEmit.value[param] = null;
            });
            emits('paramsToEmit', paramsToEmit.value);
            return;
        }
        try {
            const response = await fetch(`/api/${props.apiName}?search_key=${encodeURIComponent(value)}`);
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
    search_key.value = item.name;
    key_id.value = item.id;
    show_results.value = false;
    isSelecting.value = true; // Atur flag untuk menghentikan watch sementara
    props.parametersToAssign.forEach(param => {
        paramsToEmit.value[param] = item[param];
    });
    emits('paramsToEmit', paramsToEmit.value);
}

const navigate = (direction) => {
    if (!search_results.value.length) return;
    const maxIndex = search_results.value.length - 1;
    highlightedIndex.value = (highlightedIndex.value + direction + search_results.value.length) % search_results.value.length;
};

const selectHighlighted = () => {
    if (highlightedIndex.value >= 0 && highlightedIndex.value < search_results.value.length) {
        chooseItem(search_results.value[highlightedIndex.value]);
    }
};

</script>
<template>
    <div class="relative w-full" @keydown.down.prevent="navigate(1)" @keydown.up.prevent="navigate(-1)" @keydown.enter.prevent="selectHighlighted" >
        <input type="text" 
            v-model="search_key" 
            :placeholder="placeholder" 
            class="text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-1/2 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
        <input type="hidden" v-model="key_id">
        <ul v-if="show_results && search_results.length" class="absolute bg-white shadow-lg border rounded w-full z-10">
            <li v-for="(item, index) in search_results" 
                :key="item.id" 
                @click="chooseItem(item)" 
                :class="{'bg-gray-100': highlightedIndex === index}"
                class="p-2 hover:bg-gray-100 cursor-pointer">
                {{ item.name }}
            </li>
        </ul>
    </div>
</template>