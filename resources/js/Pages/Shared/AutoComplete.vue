<script setup>
import { reactive, ref } from 'vue';

const props = defineProps({
    source: Object,
    index: Number || null,
    placeholder: String,
});
let key_name = ref('');
let key_id = ref('');
let show_results = ref(false);

const autocomplete_data = reactive({results:[]});

const autoComplete = () => {
    // console.log(key);
    autocomplete_data.results = [];
    // console.log(autocomplete_data.results.length);

    props.source.filter((obj) => {
        if (key_name.value.trim()) {
            if (autocomplete_data.results.length <= 5) {
                if (obj.name.toLowerCase().includes(key_name.value.toLowerCase())) {
                    autocomplete_data.results.push(obj);
                }
            }
        }
    });

    if (autocomplete_data.results.length) {
        show_results.value = true;
    } else {
        show_results.value = false;
    }
    // console.log(autocomplete_data.results.length);
}

function chooseItem (item) {
    // console.log('chosen', item);
    key_name.value = item.name;
    key_id.value = item.id;
    show_results.value = false;
}
</script>
<template>
    <div class="relative">
        <input type="text" v-model="key_name" @input="autoComplete" :placeholder="placeholder" class="text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 w-full placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
        <input type="hidden" v-model="key_id">
        <div v-show="show_results" class="absolute z-20 bg-white border-x w-full">
            <div v-for="(item, index) in autocomplete_data.results" class="p-2 border-y hover:bg-slate-100 hover:cursor-pointer" @click="$emit('item', {res:item, index:props.index});chooseItem(item)">{{ item.name }}</div>
        </div>
    </div>
</template>