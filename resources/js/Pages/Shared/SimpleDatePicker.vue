<script setup>
import { DatePicker } from 'v-calendar';
import { onMounted, watch, defineEmits } from 'vue';
import { ref } from 'vue';

const props = defineProps({
    day: Number,
    month: Number,
    year: Number,
});

// Deklarasikan event yang di-emit
const emit = defineEmits(["chosen_date"]);

let show_date_picker = ref(false);
const toggleDatePicker = () => {
    show_date_picker.value = !show_date_picker.value;
    // console.log(show_date_picker.value);
}

let show_reset_button = ref(false);

let this_date = ref(new Date());
let day = ref(props.day);
let month = ref(props.month);
let year = ref(props.year);
let use_date = ref(true);

// onMounted(() => {
//     day = props.date.getDate();
//     month = props.date.getMonth() + 1;
//     year = props.date.getFullYear();
// });
watch(props, (value) => {
    day = value.day;
    month = value.month;
    year = value.year;
});

watch(this_date, (value) => {
    // console.log(this_date);
    // console.log(this_date.value);
    // console.log(value);
    // console.log(value);
    if (value) {
        day = value.getDate();
        month = value.getMonth() + 1;
        year = value.getFullYear();
        use_date = true;
    }
    // console.log(value);
    // console.log(day, month, year);
    emit('chosen_date', {value: value, use_date: use_date});

    if (day && month && year) {
        show_reset_button = true;
    }
});

function resetDate() {
    use_date = false;
    show_reset_button = false;
    emit('chosen_date', {value: null, use_date: use_date});
}

</script>
<template>
    <div @click="toggleDatePicker" class="border rounded p-2 flex justify-between items-center">
        <span v-if="use_date">{{ day }}-{{ month }}-{{ year }}</span>
        <span v-else>--</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
        </svg>
        <button type="button" @click="resetDate" v-if="show_reset_button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 text-red-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div v-show="show_date_picker">
        <DatePicker v-model="this_date" mode="date" />
        <!-- <DatePicker v-model="this_date" mode="date" @click="$emit('date', {res:item, index:props.index})" /> -->
    </div>
</template>