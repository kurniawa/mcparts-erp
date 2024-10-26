<script setup></script>
<template>
    <!-- PEMBELIAN TOTAL SUPPLIER -->
    <div class="text-xs">
        <table class="table-nice">
            <tbody>
                <tr v-for="pembelian_total_supplier in pembelian_total_suppliers"class="border-b">
                    <td>{{ pembelian_total_supplier.supplier_nama }}</td>
                    <td>
                        <div class="flex justify-between font-semibold">
                            <span>Rp</span>
                            <!-- {{ dump($pembelian_total_supplier[$i]->harga_total) }} -->
                            {{ pembelian_total_supplier.pembelian_total }}
                        </div>
                        <div class="flex justify-between text-emerald-500">
                            <span>Rp</span>
                            <!-- {{ dump($pembelian_total_supplier[$i]->harga_total) }} -->
                            {{ pembelian_total_supplier.pembelian_lunas }}
                        </div>
                        <div class="flex justify-between text-rose-500">
                            <span>Rp</span>
                            <!-- {{ dump($pembelian_total_supplier[$i]->harga_total) }} -->
                            {{ pembelian_total_supplier.pembelian_belum_lunas }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END - PEMBELIAN TOTAL SUPPLIER -->
</template>