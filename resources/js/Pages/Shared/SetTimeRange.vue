<script setup>
import { defineEmits } from 'vue';

const emit = defineEmits(["timerange"]);

function setTimeRange(timerange_type) {
    const timerange = {
        from_day: null,
        from_month: null,
        from_year: null,
        to_day: null,
        to_month: null,
        to_year: null,
    };
    
    const date_now = new Date();

    if (timerange_type === "now") {
        timerange.from_day = date_now.getDate();
        timerange.from_month = date_now.getMonth() + 1;
        timerange.from_year = date_now.getFullYear();
        timerange.to_day = timerange.from_day;
        timerange.to_month = timerange.from_month;
        timerange.to_year = timerange.from_year;
    } else if (timerange_type === "7d") {
        const to_date = date_now;
        const from_date = new Date(new Date().setDate(to_date.getDate() - 7));
        timerange.from_day = from_date.getDate();
        timerange.from_month = from_date.getMonth() + 1;
        timerange.from_year = from_date.getFullYear();
        timerange.to_day = to_date.getDate();
        timerange.to_month = to_date.getMonth() + 1;
        timerange.to_year = to_date.getFullYear();
    } else if (timerange_type === "30d") {
        const to_date = date_now;
        const from_date = new Date(new Date().setDate(to_date.getDate() - 30));
        timerange.from_day = from_date.getDate();
        timerange.from_month = from_date.getMonth() + 1;
        timerange.from_year = from_date.getFullYear();
        timerange.to_day = to_date.getDate();
        timerange.to_month = to_date.getMonth() + 1;
        timerange.to_year = to_date.getFullYear();
    } else if (timerange_type === "bulan_ini") {
        timerange.from_day = 1;
        timerange.from_month = date_now.getMonth() + 1;
        timerange.from_year = date_now.getFullYear();
        timerange.to_day = date_now.getDate();
        timerange.to_month = date_now.getMonth() + 1;
        timerange.to_year = date_now.getFullYear();
    } else if (timerange_type === "bulan_lalu") {
        timerange.from_day = 1;
        timerange.from_month = date_now.getMonth();
        timerange.from_year = date_now.getFullYear();
        timerange.to_month = date_now.getMonth();
        timerange.to_year = date_now.getFullYear();
        timerange.to_day = new Date(timerange.to_year, timerange.to_month, 0).getDate();
        if (timerange.from_month === 0) {
            timerange.from_month = 12;
            timerange.from_year--;
        }
        // console.log(from_month, to_month);
    } else if (timerange_type === "tahun_ini") {
        timerange.from_day = 1;
        timerange.from_month = 1;
        timerange.from_year = date_now.getFullYear();
        timerange.to_day = date_now.getDate();
        timerange.to_month = date_now.getMonth() + 1;
        timerange.to_year = date_now.getFullYear();
    } else if (timerange_type === "tahun_lalu") {
        timerange.from_day = 1;
        timerange.from_month = 1;
        timerange.from_year = date_now.getFullYear() - 1;
        timerange.to_day = 31;
        timerange.to_month = 12;
        timerange.to_year = timerange.from_year;
    } else if (timerange_type === "triwulan") {
        const actual_month = date_now.getMonth() + 1;
        timerange.from_day = 1;
        timerange.from_year = date_now.getFullYear();
        timerange.to_year = timerange.from_year;
        if (actual_month <= 3) {
            timerange.from_month = 1;
            timerange.to_month = 3;
        } else if (actual_month <= 6) {
            timerange.from_month = 4;
            timerange.to_month = 6;
        } else if (actual_month <= 9) {
            timerange.from_month = 7;
            timerange.to_month = 9;
        } else if (actual_month <= 12) {
            timerange.from_month = 10;
            timerange.to_month = 12;
        }
        timerange.to_day = new Date(timerange.to_year, timerange.to_month, 0).getDate();
    } else if (timerange_type === "triwulan_lalu") {
        const actual_month = date_now.getMonth() + 1;
        timerange.from_day = 1;
        timerange.from_year = date_now.getFullYear();
        timerange.to_year = timerange.from_year;
        if (actual_month <= 3) {
            timerange.from_month = 10;
            timerange.to_month = 12;
            timerange.from_year--;
            timerange.to_year--;
        } else if (actual_month <= 6) {
            timerange.from_month = 1;
            timerange.to_month = 3;
        } else if (actual_month <= 9) {
            timerange.from_month = 4;
            timerange.to_month = 6;
        } else if (actual_month <= 12) {
            timerange.from_month = 7;
            timerange.to_month = 9;
        }
        timerange.to_day = new Date(timerange.to_year, timerange.to_month, 0).getDate();
    }
    emit('timerange', timerange);
}
</script>
<template>
    <div class="mt-1">
        <div class="flex items-center">
            <div><input type="radio" name="timerange_type" value="triwulan" id="triwulan" @click="setTimeRange('triwulan')"><label for="triwulan" class="ml-1">tri.w ini</label></div>
            <div class="ml-3"><input type="radio" name="timerange_type" value="triwulan_lalu" id="triwulan_lalu" @click="setTimeRange('triwulan_lalu')"><label for="triwulan_lalu" class="ml-1">tri.w lalu</label></div>
            <div class="ml-3"><input type="radio" name="timerange_type" value="this_year" id="tahun_ini" @click="setTimeRange('tahun_ini')"><label for="tahun_ini" class="ml-1">thn.ini</label></div>
            <div class="ml-3"><input type="radio" name="timerange_type" value="last_year" id="tahun_lalu" @click="setTimeRange('tahun_lalu')"><label for="tahun_lalu" class="ml-1">thn.lalu</label></div>
        </div>
        <div class="flex items-center mt-1">
            <div><input type="radio" name="timerange_type" value="today" id="now" @click="setTimeRange('now')"><label for="now" class="ml-1">now</label></div>
            <div class="ml-3"><input type="radio" name="timerange_type" value="7d" id="7d" @click="setTimeRange('7d')"><label for="7d" class="ml-1">7d</label></div>
            <div class="ml-3"><input type="radio" name="timerange_type" value="30d" id="30d" @click="setTimeRange('30d')"><label for="30d" class="ml-1">30d</label></div>
            <div class="ml-3"><input type="radio" name="timerange_type" value="bulan_ini" id="bulan_ini" @click="setTimeRange('bulan_ini')"><label for="bulan_ini" class="ml-1">bln.ini</label></div>
            <div class="ml-3"><input type="radio" name="timerange_type" value="bulan_lalu" id="bulan_lalu" @click="setTimeRange('bulan_lalu')"><label for="bulan_lalu" class="ml-1">bln.lalu</label></div>
        </div>
        <div class="mt-1">
            <div><input type="radio" name="timerange_type" value="none" id="none" @click="setTimeRange('none')"><label for="none" class="ml-1">none</label></div>
        </div>
    </div>
</template>