<script setup>
import { useForm } from '@inertiajs/vue3';
import SimpleDatePicker from '../Shared/SimpleDatePicker.vue';
import SetTimeRange from '../Shared/SetTimeRange.vue';
import AutoCompleteAPI from '../Shared/AutoCompleteAPI.vue';
import { ref, watch } from 'vue';

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
    customer: {
        id: null,
        nama: null,
        reseller_id: null,
    },
    status_bayar: []
})

const parametersToAssign = ref(['id', 'name', 'reseller_id']);

watch(form, (value)=>{
    if (value.status_bayar.includes('all')) {
        value.status_bayar = ['all'];
    }
    // console.log(value.status_bayar);
});

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

function filterSPKs() {
    // console.log(form);
    form.get(route('home'));
}

function chooseCustomer (chosenCustomer) {
    // console.log("listened", chosenCustomer);
    // form.customer.id = result.res.id;
    // form.customer.nama = result.res.name;
    // console.log(form.result);
    form.customer.id = chosenCustomer.id;
    form.customer.nama = chosenCustomer.name;
    form.customer.reseller_id = chosenCustomer.reseller_id;
    // console.log(form.customer);
}
</script>
<template>
    <div class="w-full text-xs bg-orange-50" id="filter-content">
        <div class="border rounded border-orange-300 p-2">
            <form @submit.prevent="filterSPKs">
                <div class="mt-2" >
                    <label>Pelanggan:</label>
                    <div class="mt-1">
                        <AutoCompleteAPI apiName="search-customers" placeholder="nama pelanggan ..." @paramsToEmit="chooseCustomer" :parametersToAssign="parametersToAssign" />
                    </div>
                </div>
                <div class="mt-2">
                    Rentang waktu:
                    <SetTimeRange @timerange="setTimeRange"/>
                </div>
                <!-- <div>
                    status_bayar:
                    <ul class="flex">
                        <li><input type="checkbox" v-model="form.status_bayar" class="rounded" value="all" id="all"><label for="all" class="ml-1">all</label></li>
                        <li class="ml-3"><input type="checkbox" v-model="form.status_bayar" class="rounded" value="lunas" id="lunas"><label for="lunas" class="ml-1">lunas</label></li>
                        <li class="ml-3"><input type="checkbox" v-model="form.status_bayar" class="rounded" value="belum" id="belum"><label for="belum" class="ml-1">belum</label></li>
                        <li class="ml-3"><input type="checkbox" v-model="form.status_bayar" class="rounded" value="sebagian" id="sebagian"><label for="sebagian" class="ml-1">sebagian</label></li>
                    </ul>
                </div> -->
                <div class="flex mt-2">
                    <div class="flex">
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
                    <button type="submit" class="rounded bg-orange-200 text-orange-500 p-2">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>
</template>