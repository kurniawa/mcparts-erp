<script setup>
import { useForm } from '@inertiajs/vue3';
import SimpleDatePicker from '../Shared/SimpleDatePicker.vue';
import SetTimeRange from '../Shared/SetTimeRange.vue';
import AutoComplete from '../Shared/AutoComplete.vue';

const props = defineProps({
    label_suppliers: Object
});

const form = useForm({
    from_day: null,
    from_month: null,
    from_year: null,
    from_time: "00:00:00",
    use_from_date: true,
    to_day: null,
    to_month: null,
    to_year: null,
    to_time: "23:59:59",
    use_to_date: true,
    supplier: {
        id: null,
        nama: null,
    },
    status_bayar: [],
})

// watch(form, (value) => {
//     console.log(value);
// });

function emitFromDate(chosen_date) {
    // console.log('emitted_date');
    // console.log(chosen_date);
    if (chosen_date) {
        form.from_day = chosen_date.value.getDate();
        form.from_month = chosen_date.value.getMonth() + 1;
        form.from_year = chosen_date.value.getFullYear();
        // console.log(form);
    }
    form.use_from_date = chosen_date.use_date;
}

function emitToDate(chosen_date) {
    if (chosen_date) {
        form.to_day = chosen_date.getDate();
        form.to_month = chosen_date.getMonth() + 1;
        form.to_year = chosen_date.getFullYear();
        form.use_to_date = true;
    } else {
        form.use_to_date = false;
    }
}

function setTimeRange(chosen_timerange) {
    // console.log(chosen_timerange);
    form.from_day = chosen_timerange.from_day;
    form.from_month = chosen_timerange.from_month;
    form.from_year = chosen_timerange.from_year;
    form.to_day = chosen_timerange.to_day;
    form.to_month = chosen_timerange.to_month;
    form.to_year = chosen_timerange.to_year;
}

function filterPembelians() {
    // console.log(form);
    form.get(route('pembelians.index'));
}

function chooseSupplier (chosen) {
    // console.log("listened", chosen);
    // form.supplier.id = result.res.id;
    // form.supplier.nama = result.res.name;
    // console.log(form.result);
    form.supplier.id = chosen.res.id;
    form.supplier.nama = chosen.res.name;
    console.log(form);
}

</script>
<template>
    <div class="flex justify-center text-xs" id="filter-content">
        <div class="border rounded border-orange-300 p-2 inline-block">
            <form @submit.prevent="filterPembelians">
                <div class="ml-1 mt-2 flex">
                    <div>
                        <label>Supplier:</label>
                        <div class="flex mt-1">
                            <AutoComplete :source="label_suppliers" :index="null" @item="chooseSupplier"></AutoComplete>
                        </div>
                    </div>
                    <div class="ml-2">
                        Rentang waktu:
                        <SetTimeRange @timerange="setTimeRange"/>
                    </div>
                </div>
                <div class="ml-1">
                    status_bayar:
                    <div class="flex">
                        <div><input type="checkbox" name="status_bayar[]" v-model="form.status_bayar" class="rounded" value="all" id="all"><label for="all" class="ml-1">all</label></div>
                        <div class="ml-3"><input type="checkbox" name="status_bayar[]" v-model="form.status_bayar" class="rounded" value="lunas" id="lunas"><label for="lunas" class="ml-1">lunas</label></div>
                        <div class="ml-3"><input type="checkbox" name="status_bayar[]" v-model="form.status_bayar" class="rounded" value="belum" id="belum"><label for="belum" class="ml-1">belum</label></div>
                        <div class="ml-3"><input type="checkbox" name="status_bayar[]" v-model="form.status_bayar" class="rounded" value="sebagian" id="sebagian"><label for="sebagian" class="ml-1">sebagian</label></div>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div class="ml-1 flex">
                        <div>
                            <label>Dari:</label>
                            <SimpleDatePicker :day="form.from_day" :month="form.from_month" :year="form.from_year" @chosen_date="emitFromDate"/>
                        </div>
                        <div class="ml-3">
                            <label>Sampai:</label>
                            <SimpleDatePicker :day="form.to_day" :month="form.to_month" :year="form.to_year" @chosen_date="emitToDate"/>
                        </div>
                    </div>
                </div>
                <div class="mt-2 text-right">
                    <button type="submit" class="rounded bg-orange-200 text-orange-400 p-2">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>
</template>