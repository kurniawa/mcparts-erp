<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import SPKs from "./Home/SPKs.vue";
import Tab from "./Shared/Tab.vue";
import AddSPK from "./Home/AddSPK.vue";

defineProps({
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
    label_pelanggans: {type: Object},
    label_produks: {type: Object},
})
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
            <div>
                <AddSPK :label_pelanggans="label_pelanggans" />
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
