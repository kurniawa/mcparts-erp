<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    session: Object
})

const form = useForm({});

const submitPembeliansNumbersDataTimes100 = () => {
    // console.log('submitted');
    const sure = confirm('Anda yakin modifikasi table pembelians?');
    if (sure) {
        form.post(route('initial_commands.pembelians_numbers_data_times_100'), {preserveScroll:true});
    }
    // post(route('initial_commands.pembelians_numbers_data_times_100'));
}

const submitCancelPembeliansNumbersDataTimes100 = () => {
    const sure = confirm('Anda yakin modifikasi table pembelians?');
    // console.log(sure);
    if (sure) {
        form.post(route('initial_commands.cancel_pembelians_numbers_data_times_100'), {preserveScroll:true});
    }
}

const submitUpdatePembelianStatusBayarValue = () => {
    const sure = confirm('Anda yakin initial_commands.update_pembelian_status_bayar?');
    // console.log(sure);
    if (sure) {
        form.post(route('initial_commands.update_pembelian_status_bayar'), {preserveScroll:true});
    }
}

const submitPembelianBarangsNumbersDataTimes100 = () => {
    // console.log('submitted');
    const sure = confirm('Anda yakin modifikasi table pembelian_barangs?');
    if (sure) {
        form.post(route('initial_commands.pembelian_barangs_numbers_data_times_100'), {preserveScroll:true});
    }
}

const submitCancelPembelianBarangsNumbersDataTimes100 = () => {
    const sure = confirm('Anda yakin modifikasi table pembelian_barangs?');
    // console.log(sure);
    if (sure) {
        form.post(route('initial_commands.cancel_pembelian_barangs_numbers_data_times_100'), {preserveScroll:true});
    }
}

const submitUpdatePembelianBarangsStatusBayar = () => {
    const sure = confirm('Anda yakin modifikasi table pembelian_barangs: status_bayar: BELUM menjadi BELUM-LUNAS');
    // console.log(sure);
    if (sure) {
        form.post(route('initial_commands.update_pembelian_barangs_status_bayar'), {preserveScroll:true});
    }
}

const submitBarangsNumbersDataTimes100 = () => {
    const sure = confirm('Anda yakin modifikasi table pembelian_barangs?');
    if (sure) {
        form.post(route('initial_commands.barangs_numbers_data_times_100'), {preserveScroll:true});
    }
}

const submitCancelBarangsNumbersDataTimes100 = () => {
    const sure = confirm('Anda yakin modifikasi table pembelian_barangs?');
    if (sure) {
        form.post(route('initial_commands.cancel_barangs_numbers_data_times_100'), {preserveScroll:true});
    }
}
</script>
<template>
    <AuthenticatedLayout>
        <h1>Initial Commands Center</h1>
        <!-- <x-validation-feedback></x-validation-feedback> -->
        <!-- <SessionFeedback></SessionFeedback> -->
        <ol class="list-decimal list-inside">
            <li>php artisan migrate --path=/database/migrations/0001_01_01_000000_create_users_table.php</li>
            <li>php artisan migrate --path=/database/migrations/0001_01_01_000001_create_cache_table.php</li>
            <li>php artisan migrate --path=/database/migrations/0001_01_01_000002_create_jobs_table</li>
            <li class="p-2">
                Pada table user
                <ul class="list-disc list-inside">
                    <li>add column clearance_level, tinyInteger, length:1, unsigned, default:1</li>
                    <li>update clearance_level dari setiap user</li>
                </ul>
            </li>
            <li class="p-2">
                Pada tabel nota:
                <ul class="list-disc list-inside">
                    <li>add column sisa_bayar bigInteger, tidak boleh nullable, defaultnya 0, meski harusnya default sama dengan harga_total</li>
                    <li>ubah tipe data jumlah_total menjadi MediumInteger.</li>
                    <li>ubah tipe data harga_total menjadi BigInteger, karena ini berkaitan dengan jumlah uang.</li>
                    <li>tambahkan kolom tanggal_lunas.</li>
                    <li>ubah default status_bayar menjadi 'BELUM-LUNAS', length: 20</li>
                </ul>
            </li>
            <li class="p-2">
                Pada table pembelian:
                <ul class="list-disc list-inside">
                    <li>ubah tipe data harga_total dari Decimal menjadi BigInteger, karena ini berkaitan dengan jumlah uang.</li>
                    <li>
                        <span>Karena diubah menjadi BigInteger, maka semua data number harus dikali 100. (Melalui Controller)</span>
                        <div class="flex gap-2">
                            <form @submit.prevent="submitPembeliansNumbersDataTimes100">
                                <!-- <input type="hidden" v-model="form.name"> -->
                                <button class="bg-orange-300 text-white font-bold p-2 rounded">pembelians: numbers data type * 100</button>
                            </form>
                            <form @submit.prevent="submitCancelPembeliansNumbersDataTimes100">
                                <button class="bg-rose-300 text-white font-bold p-2 rounded">cancel</button>
                            </form>
                        </div>
                    </li>
                    <li>add column sisa_bayar bigInteger, untuk awal di set default sebagai nullable kalau bisa, kalau tidak bisa maka default 0</li>
                    <li>ubah default status_bayar menjadi 'BELUM-LUNAS'</li>
                    <li>ubah nama column creator menjadi created_by, updater menjadi updated_by</li>
                    <li>
                        ubah value dari status_bayar BELUM menjadi BELUM-LUNAS:
                        <form @submit.prevent="submitUpdatePembelianStatusBayarValue">
                            <button type="submit" class="bg-orange-300 text-white p-2 rounded-lg">pembelian->status_bayar BELUM to BELUM-LUNAS</button>
                        </form>
                    </li>
                    
                </ul>
            </li>
            <li class="p-2">
                Pada table pembelian_barangs:
                <ul class="list-disc list-inside">
                    <li>ubah tipe data harga_main, harga_sub, harga_t dari Decimal menjadi BigInteger, karena ini berkaitan dengan jumlah uang.</li>
                    <li>
                        <span>Karena diubah menjadi BigInteger, maka semua data number harus dikali 100. (Melalui Controller)</span>
                        <div class="flex gap-2">
                            <form @submit.prevent="submitPembelianBarangsNumbersDataTimes100">
                                <!-- <input type="hidden" v-model="form.name"> -->
                                <button class="bg-orange-300 text-white font-bold p-2 rounded">pembelian_barangs: numbers data type * 100</button>
                            </form>
                            <form @submit.prevent="submitCancelPembelianBarangsNumbersDataTimes100">
                                <button class="bg-rose-300 text-white font-bold p-2 rounded">cancel</button>
                            </form>
                        </div>
                    </li>
                    <li>
                        ubah value dari status_bayar BELUM menjadi BELUM-LUNAS:
                        <form @submit.prevent="submitUpdatePembelianBarangsStatusBayar">
                            <button type="submit" class="bg-orange-300 text-white p-2 rounded-lg">pembelian_barangs: status_bayar: BELUM to BELUM-LUNAS</button>
                        </form>
                    </li>
                </ul>
            </li>
            <li class="p-2">
                Pada table barangs:
                <ul class="list-disc list-inside">
                    <li>ubah tipe data harga_main, harga_sub, harga_total_main, harga_total_sub menjadi BigInteger, karena ini berkaitan dengan jumlah uang.</li>
                    <li>
                        <span>Karena diubah menjadi BigInteger, maka semua data number harus dikali 100. (Melalui Controller)</span>
                        <div class="flex gap-2">
                            <form @submit.prevent="submitBarangsNumbersDataTimes100">
                                <!-- <input type="hidden" v-model="form.name"> -->
                                <button class="bg-orange-300 text-white font-bold p-2 rounded">barangs: numbers data type * 100</button>
                            </form>
                            <form @submit.prevent="submitCancelBarangsNumbersDataTimes100">
                                <button class="bg-rose-300 text-white font-bold p-2 rounded">cancel</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
        </ol>
        <div class="grid grid-cols-3 gap-2">
            <button class="btn btn-primary">primary</button>
            <button class="btn btn-secondary">secondary</button>
            <button class="btn btn-accent">accent</button>
            <button class="btn btn-neutral">neutral</button>
            <button class="btn">btn</button>
        </div>
        </AuthenticatedLayout>
</template>
