<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    spks: {type: Object},
    profile_pictures_paths: {type: Array},
    col_spk_produks: {type: Object},
});

// Setiap spk memiliki spk_items. Pada tampilan awal, spk_items hidden terlebih dahulu
// onMounted berikut untuk membantu mekanisme untuk hidden spk_items
const showSPKItems = ref([]);
onMounted(() => {
    if (props.spks.length) {
        showSPKItems.value = Array(props.spks.length).fill(false);
    }
})

function toggleSPKItems(SPKIndex) {
    showSPKItems.value[SPKIndex] = !showSPKItems.value[SPKIndex];
    console.log(showSPKItems.value[SPKIndex]);
}
</script>

<template>
    <div class="mx-1 py-1 sm:px-6 lg:px-8 text-xs">
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
        </template>
    </div>
</template>