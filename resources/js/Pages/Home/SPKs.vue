<script setup>
import { Link } from '@inertiajs/vue3';
import { formatCurrencyIDw100 } from '../../../../public/js/functions.js';
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    spks: {type: Object},
    profile_pictures_paths: {type: Array},
    nama_pelanggans: {type: Array},
    col_notas: {type: Object},
    col_srjalans: {type: Object},
    col_spk_produks: {type: Object},
    col_spk_produk_notas: {type: Object},
    col_spk_produk_nota_srjalans: {type: Object},
});

// Setiap spk memiliki spk_items. Pada tampilan awal, spk_items hidden terlebih dahulu
// onMounted berikut untuk membantu mekanisme untuk hidden spk_items
const showSPKItems = ref([]);
onMounted(() => {
    if (props.spks.length) {
        showSPKItems.value = Array(props.spks.length).fill(false);
    }
})

// Preprocess formatted date
const spksWithFormattedDate = computed(() =>
  props.spks.map(spk => {
    const created_at = new Date(spk.created_at);
    let finished_at = null;
    let formattedFinishedAt = null;
    if (spk.finished_at) {
        finished_at = new Date(spk.finished_at);
        formattedFinishedAt = {
            day: finished_at.getDate().toString().padStart(2, '0'),
            month: (finished_at.getMonth() + 1).toString().padStart(2, '0'),
            year: finished_at.getFullYear().toString().slice(-2),
        }
    }

    return {
      ...spk,
      formattedCreatedAt: {
        day: created_at.getDate().toString().padStart(2, '0'),
        month: (created_at.getMonth() + 1).toString().padStart(2, '0'),
        year: created_at.getFullYear().toString().slice(-2),
      },
      formattedFinishedAt: formattedFinishedAt,
    };
  })
);

// console.log(props.profile_pictures_paths);
// console.log(props.col_srjalans);
function toggleSPKItems(SPKIndex) {
    showSPKItems.value[SPKIndex] = !showSPKItems.value[SPKIndex];
    // console.log(showSPKItems.value[SPKIndex]);
}
</script>

<template>
    <div class="mx-1 py-1 sm:px-6 lg:px-8 text-xs">
        <div class="grid grid-cols-3 gap-1">
            <div class="text-center bg-violet-200 rounded-t font-bold text-slate-700 py-1">SPK</div>
            <div class="text-center bg-emerald-200 rounded-t font-bold text-slate-700 py-1">Nota</div>
            <div class="text-center bg-orange-200 rounded-t font-bold text-slate-700 py-1">SJ</div>
            <!-- SPKs -->
            <template v-for="(spk, index_spk) in spks">
                <div>
                    <div class="grid grid-cols-3 border-t pt-1">
                        <div class="grow">
                            <Link :href="route('spks.show', spk.id)" class="font-bold text-indigo-500">{{ spk.no_spk }}</Link>
                            <div>
                                <Link :href="route('spks.show', spk.id)" class="text-indigo-800">
                                    <span v-if="spk.pxr_name">{{ spk.pxr_name }}</span>
                                    <span v-else>{{ spk.pelanggan_nama }}</span>
                                </Link>
                            </div>
                            <div>
                                <!-- <button :id="'toggle-spk-items-'$index_spk" class="rounded bg-white shadow drop-shadow" onclick="showDropdown(this.id, 'spk-items-{{ $key }}')"> -->
                                <button class="rounded bg-white shadow drop-shadow" @click="toggleSPKItems(index_spk)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex">
                                <div v-if="!spk.finished_at">
                                    <div class="rounded p-1 bg-red-500 text-white font-bold text-center">
                                        <div>{{ spk.created_day }}</div>
                                        <div>{{ spk.created_month }}-{{ spk.created_year }}</div>
                                    </div>
                                </div>
                                <div v-else>
                                    <div class="rounded p-1 bg-yellow-500 text-white font-bold text-center">
                                        <div>{{ spk.created_day }}</div>
                                        <div>{{ spk.created_month }}-{{ spk.created_year }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex ml-1">
                                <div v-if="spk.finished_at">
                                    <div class="rounded p-1 bg-emerald-500 text-white font-bold text-center">
                                        <div>{{ spk.finished_day }}</div>
                                        <div>{{ spk.finished_month }}-{{ spk.finished_year }}</div>
                                    </div>
                                </div>
                                <span v-else class="font-bold">--</span>
                            </div>
                        </div>
                        <div class="flex">
                            <div v-if="props.profile_pictures_paths[index_spk]" class="w-8 h-8 rounded-full overflow-hidden">
                                <img class="w-full" :src="props.profile_pictures_paths[index_spk]" alt="">
                            </div>
                            <div v-else class="w-8 h-8 rounded-full overflow-hidden bg-slate-200 text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <!-- SPK Items -->
                    <div v-if="showSPKItems[index_spk]" class="border rounded px-1">
                        <table class="w-full text-xs">
                            <tr v-for="spk_produk in col_spk_produks[index_spk]">
                                <td>{{ spk_produk.nama_produk }}</td>
                                <td>
                                    {{ spk_produk.jumlah }}
                                    <span v-if="spk_produk.deviasi_jml > 0" class="text-indigo-500"> +{{ spk_produk.deviasi_jml }}</span>
                                    <span v-else-if="spk_produk.deviasi_jml < 0" class="text-pink-500"> -{{ spk_produk.deviasi_jml }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END - SPK Items -->
                    <!-- END - SPK -->
                </div>
                <div>
                    <div v-if="col_notas[index_spk].length === 0" class="flex border-t pt-1 justify-center">
                        <div>none</div>
                    </div>
                    <template v-else>
                        <div v-for="(nota, index_nota) in col_notas[index_spk]">
                            <div class="grid grid-cols-2 border-t pt-1">
                                <div>
                                    <a class="font-bold text-emerald-400" :href="route('spks.show', spk.id)">{{ nota.no_nota }}</a>
                                    <div>
                                        <button class="rounded bg-white shadow drop-shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="font-bold" >{{ formatCurrencyIDw100(nota.harga_total) }}</div>
                                </div>
                                <div class="flex">
                                    <div class="flex">
                                        <div v-if="!nota.finished_at">
                                            <div class="rounded p-1 bg-red-500 text-white font-bold text-center">
                                                <div>{{ nota.created_day }}</div>
                                                <div>{{ nota.created_month }}-{{ nota.created_year }}</div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="rounded p-1 bg-yellow-500 text-white font-bold text-center">
                                                <div>{{ nota.created_day }}</div>
                                                <div>{{ nota.created_month }}-{{ nota.created_year }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex ml-1 items-center">
                                        <div v-if="nota.finished_at">
                                            <div class="rounded p-1 bg-emerald-500 text-white font-bold text-center">
                                                <div>{{ nota.finished_day }}</div>
                                                <div>{{ nota.finished_month }}-{{ nota.finished_year }}</div>
                                            </div>
                                        </div>
                                        <span v-else class="font-bold">--</span>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Nota Items -->
                            <div class="border rounded px-1 hidden" id="nota-items-{{ $key }}-{{ $key_nota }}">
                                <table class="w-full text-xs">
                                    <tr v-for="spk_produk_nota in col_spk_produk_notas[index_spk][index_nota]"><td>{{ spk_produk_nota.nama_nota }}</td><td>{{ spk_produk_nota.jumlah }}</td></tr>
                                </table>
                            </div>
                            <!-- END - Nota Items -->
                        </div>
                    </template>
                </div>
                <div>
                    <template v-for="(nota, index_nota) in col_notas[index_spk]">
                        <div v-if="!col_srjalans[index_spk][index_nota].length" class="flex border-t pt-1 justify-center">
                            <div>none</div>
                        </div>
                        <template v-else>
                            <div v-for="(srjalan, index_srjalan) in col_srjalans[index_spk][index_nota]">
                                <div class="grid grid-cols-2 border-t pt-1">
                                    <div>
                                        <a class="font-bold text-sky-400" :href="route('spks.show', spk.id)">{{ srjalan.no_srjalan }}</a>
                                        <span>ekspedisi: </span><a href="#" class="text-sky-700">{{ srjalan.ekspedisi_nama }}</a>
                                        <span v-if="srjalan.transit_nama"> - transit: </span><a href="#" class="text-sky-700">{{ srjalan.transit_nama }}</a>
                                        <div>
                                            <button id="toggle-srjalan-items-{{ $key }}-{{ $key2 }}-{{ $key_srjalan }}" class="rounded bg-white shadow drop-shadow" @click="showDropdown(this.id, 'srjalan-items-{{ $key }}-{{ $key2 }}-{{ $key_srjalan }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex">
                                            <div v-if="!srjalan.finished_at">
                                                <div class="rounded p-1 bg-red-500 text-white font-bold text-center">
                                                    <div>{{ srjalan.created_day }}</div>
                                                    <div>{{ srjalan.created_month }}-{{ srjalan.created_year }}</div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="rounded p-1 bg-yellow-500 text-white font-bold text-center">
                                                    <div>{{ srjalan.created_day }}</div>
                                                    <div>{{ srjalan.created_month }}-{{ srjalan.created_year }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex ml-1 items-center">
                                            <div v-if="srjalan.finished_at">
                                                <div class="rounded p-1 bg-emerald-500 text-white font-bold text-center">
                                                    <div>{{ srjalan.finished_day }}</div>
                                                    <div>{{ srjalan.finished_month }}-{{ srjalan.finished_year }}</div>
                                                </div>
                                            </div>
                                            <span v-else class="font-bold">--</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Srjalan Items -->
                                <div class="border rounded px-1 hidden" id="srjalan-items-{{ $key }}-{{ $key2 }}-{{ $key_srjalan }}">
                                    <table class="w-full text-xs">
                                        <template v-if="col_spk_produk_nota_srjalans.indexOf(index_spk) !== -1">
                                            <template v-if="col_spk_produk_nota_srjalans[index_spk].indexOf(index_nota) !== -1">
                                                <tr v-for="spk_produk_nota_srjalan in col_spk_produk_nota_srjalans[index_spk][index_nota]"><td>{{ spk_produk_nota_srjalan.nama_nota }}</td><td>{{ spk_produk_nota_srjalan.jumlah_packing }}</td><td>{{ spk_produk_nota_srjalan.tipe_packing }}</td></tr>
                                            </template>
                                        </template>
                                        <tr v-else><td>nama nota ??</td><td>jumlah packing ??</td><td>tipe packing ??</td></tr>
                                    </table>
                                </div>
                                <!-- END - Srjalan Items -->
                            </div>
                        </template>
                    </template>
                </div>
            </template>
        </div>
    </div>
</template>