<script setup></script>
<template>
    <div class="" id="filter-content">
        <div class="rounded p-2 bg-white shadow drop-shadow inline-block">
            <form action="" method="GET">
                <div class="ml-1 mt-2 flex">
                    <div>
                        <label>Supplier:</label>
                        <div class="flex mt-1">
                            <input type="text" class="border rounded text-xs p-1" name="supplier_nama" placeholder="Nama Supplier..." id="supplier_nama">
                            <input type="hidden" name="supplier_id" id="supplier_id">
                        </div>
                    </div>
                    <div class="ml-2">
                        Rentang waktu:
                        <div class="mt-1">
                            <div class="flex items-center">
                                <div><input type="radio" name="timerange" value="triwulan" id="triwulan" onclick="set_time_range('triwulan')"><label for="triwulan" class="ml-1">triwulan ini</label></div>
                                <div class="ml-3"><input type="radio" name="timerange" value="triwulan_lalu" id="triwulan_lalu" onclick="set_time_range('triwulan_lalu')"><label for="triwulan_lalu" class="ml-1">triwulan lalu</label></div>
                                <div class="ml-3"><input type="radio" name="timerange" value="this_year" id="tahun_ini" onclick="set_time_range('tahun_ini')"><label for="tahun_ini" class="ml-1">tahun ini</label></div>
                                <div class="ml-3"><input type="radio" name="timerange" value="last_year" id="tahun_lalu" onclick="set_time_range('tahun_lalu')"><label for="tahun_lalu" class="ml-1">tahun lalu</label></div>
                            </div>
                            <div class="flex items-center">
                                <div><input type="radio" name="timerange" value="today" id="now" onclick="set_time_range('now')"><label for="now" class="ml-1">now</label></div>
                                <div class="ml-3"><input type="radio" name="timerange" value="7d" id="7d" onclick="set_time_range('7d')"><label for="7d" class="ml-1">7d</label></div>
                                <div class="ml-3"><input type="radio" name="timerange" value="30d" id="30d" onclick="set_time_range('30d')"><label for="30d" class="ml-1">30d</label></div>
                                <div class="ml-3"><input type="radio" name="timerange" value="bulan_ini" id="bulan_ini" onclick="set_time_range('bulan_ini')"><label for="bulan_ini" class="ml-1">bulan ini</label></div>
                                <div class="ml-3"><input type="radio" name="timerange" value="bulan_lalu" id="bulan_lalu" onclick="set_time_range('bulan_lalu')"><label for="bulan_lalu" class="ml-1">bulan lalu</label></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-1">
                    status_bayar:
                    <div class="flex">
                        <div><input type="checkbox" name="status_bayar[]" class="rounded" value="all" id="all"><label for="all" class="ml-1">all</label></div>
                        <div class="ml-3"><input type="checkbox" name="status_bayar[]" class="rounded" value="lunas" id="lunas"><label for="lunas" class="ml-1">lunas</label></div>
                        <div class="ml-3"><input type="checkbox" name="status_bayar[]" class="rounded" value="belum" id="belum"><label for="belum" class="ml-1">belum</label></div>
                        <div class="ml-3"><input type="checkbox" name="status_bayar[]" class="rounded" value="sebagian" id="sebagian"><label for="sebagian" class="ml-1">sebagian</label></div>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div class="ml-1 flex">
                        <div>
                            <label>Dari:</label>
                            <div class="flex">
                                <select name="from_day" id="from_day" class="rounded text-xs py-1">
                                    <option value="">-</option>
                                    <option v-for="day in 31" value="{{ day }}">{{ day }}</option>
                                </select>
                                <select name="from_month" id="from_month" class="rounded text-xs py-1 ml-1">
                                    <option value="">-</option>
                                    <option v-for="month in 12" value="{{ month }}">{{ month }}</option>
                                </select>
                                <select name="from_year" id="from_year" class="rounded text-xs py-1 ml-1">
                                    <option value="{{ year_now }}">{{ year_now }}</option>
                                    <option value="">-</option>
                                    <option v-for="year_old in (year_now-30)" value="{{ year_old }}">{{ year_old }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="ml-3">
                            <label>Sampai:</label>
                            <div class="flex items-center">
                                <select name="to_day" id="to_day" class="rounded text-xs py-1">
                                    <option value="">-</option>
                                    <option v-for="day in 31" value="{{ day }}">{{ day }}</option>
                                </select>
                                <select name="to_month" id="to_month" class="rounded text-xs py-1 ml-1">
                                    <option value="">-</option>
                                    <option v-for="month in 12" value="{{ month }}">{{ month }}</option>
                                </select>
                                <select name="to_year" id="to_year" class="rounded text-xs py-1 ml-1">
                                    <option value="{{ year_now }}">{{ year_now }}</option>
                                    <option value="">-</option>
                                    <option v-for="year_old in (year_now-30)" value="{{ year_old }}">{{ year_old }}</option>
                                </select>
                                <button type="submit" class="ml-2 flex items-center bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-700">
                                    <span class="ml-1">tetapkan filter</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>