<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import SPKs from "./Home/SPKs.vue";
import Tab from "./Shared/Tab.vue";
import AddSPK from "./Home/AddSPK.vue";
import { ref, watch } from "vue";
import FilterSPK from "./Home/FilterSPK.vue";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    session: {type: Object},
    spks: {type: Object},
    profile_pictures_paths: {type: Array},
    nama_pelanggans: {type: Object},
    col_notas: {type: Object},
    col_srjalans: {type: Object},
    col_spk_produks: {type: Object},
    col_spk_produk_notas: {type: Object},
    col_spk_produk_nota_srjalans: {type: Object},
    // label_pelanggans: {type: Object},
    // label_produks: {type: Object},
})

const showFilterSPK = ref(false);
let classForBtnFilterSPK = ref('border rounded border-orange-300 text-orange-500 font-semibold px-3 py-1');
const toggleFilterSPK = () => {
    showFilterSPK.value = !showFilterSPK.value;
    if (showFilterSPK.value) {
        classForBtnFilterSPK.value = 'border rounded border-orange-300 text-orange-500 bg-orange-200 font-semibold px-3 py-1';
    } else {
        classForBtnFilterSPK.value = 'border rounded border-orange-300 text-orange-500 font-semibold px-3 py-1';
    }
}

const showAddNewSPK = ref(false);
let classForBtnAddNewSPK = ref('border rounded border-emerald-300 text-emerald-500 font-semibold px-3 py-1');
const toggleAddNewSPK = () => {
    showAddNewSPK.value = !showAddNewSPK.value;
    if (showAddNewSPK.value) {
        classForBtnAddNewSPK.value = 'border rounded border-emerald-300 text-emerald-500 bg-emerald-200 font-semibold px-3 py-1';
    } else {
        classForBtnAddNewSPK.value = 'border rounded border-emerald-300 text-emerald-500 font-semibold px-3 py-1';
    }
}
</script>

<template>
    <AuthenticatedLayout v-if="$page.props.auth.user">
        <Head title="Welcome" />
        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
            <!-- <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </Link> -->

            <template v-if="!$page.props.auth.user">
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Register
                </Link>
            </template>
        </nav>
        <!-- <h1>Hello</h1>
        <div class="mt-2">
            <Link :href="route('initial_commands.index')" class="bg-orange-300 text-white p-2 rounded">Initial Commands</Link>
        </div> -->
        <Tab :tabs="['home', 'pelanggans.index', 'ekspedisis.index', 'produks.index']" :titles="['SPK', 'Pelanggan', 'Ekspedisi', 'Produk']">
            <div class="flex gap-2 text-xs">
                <div>
                    <button type="button" :class="classForBtnFilterSPK" @click="toggleFilterSPK">Filter</button>
                </div>
                <div>
                    <button type="button" :class="classForBtnAddNewSPK" @click="toggleAddNewSPK">+ New SPK</button>
                </div>
            </div>
            <div v-show="showAddNewSPK || showFilterSPK">
                <div class="grid grid-cols-12 gap-1 mt-1">
                    <div v-show="showFilterSPK" class="col-span-6">
                        <FilterSPK />
                    </div>
                    <div v-show="showAddNewSPK" class="col-span-6">
                        <AddSPK />
                    </div>
                </div>
            </div>
            <SPKs :spks="spks" :profile_pictures_paths="profile_pictures_paths" 
            :nama_pelanggans="nama_pelanggans" :col_notas="col_notas" :col_srjalans="col_srjalans" 
            :col_spk_produks="col_spk_produks" :col_spk_produk_notas="col_spk_produk_notas" 
            :col_spk_produk_nota_srjalans="col_spk_produk_nota_srjalans" />
        </Tab>
    </AuthenticatedLayout>
    <GuestLayout v-else>
        <Head title="Welcome" />
        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Register
                </Link>
            </template>
        </nav>
        <!-- <h1>Hello</h1>
        <div class="mt-2">
            <Link :href="route('initial_commands.index')" class="bg-orange-300 text-white p-2 rounded">Initial Commands</Link>
        </div> -->
    </GuestLayout>
</template>
