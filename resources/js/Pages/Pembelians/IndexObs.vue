<script setup></script>
<template>
    <table class="table-nice w-full">
        <tbody>
            <tr>
                <th>Grand Total</th>
                <th>
                    <div class="flex justify-between bg-pink-200">
                        <span>Rp</span>
                        <!-- <span>{{ grand_total - lunas_total }}</span> -->
                        <span>{{ grand_total - lunas_total }}</span>
                    </div>
                </th>
                <th>
                    <div class="flex justify-between bg-emerald-200">
                        <span>Rp</span>
                        <span>{{ lunas_total }}</span>
                    </div>
                </th>
                <th>
                    <div class="flex justify-between">
                        <span>Rp</span>
                        <span>{{ grand_total }}</span>
                    </div>
                </th>
            </tr>
            <template v-for="(pembelian, index) in pembelians">
                <tr class="border-b">
                    <td colspan="5">
                        <div class="collapse">
                            <div>
                                <div class="flex">
                                    <div class="flex">
                                        <div v-if="!pembelian.tanggal_lunas">
                                            <div class="rounded p-1 bg-pink-200 text-pink-500 font-bold text-center">
                                                <div class="min-w-max">{{ pembelian.created_at.substring(8,10) }}-{{ pembelian.created_at.substring(5,7) }}</div>
                                                <div class="min-w-max">{{ pembelian.created_at.substring(0,4) }}</div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="rounded p-1 bg-sky-200 text-sky-500 font-bold text-center">
                                                <div class="min-w-max">{{ pembelian.created_at.substring(8,10) }}-{{ pembelian.created_at.substring(5,7) }}</div>
                                                <div class="min-w-max">{{ pembelian.created_at.substring(0,4) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex ml-1 items-center">
                                        <div v-if="pembelian.tanggal_lunas">
                                            <div class="rounded p-1 bg-emerald-200 text-emerald-500 font-bold text-center">
                                                <div class="min-w-max">{{ pembelian.tanggal_lunas.substring(8,10) }}-{{ pembelian.tanggal_lunas.substring(5,7) }}</div>
                                                <div class="min-w-max">{{ pembelian.tanggal_lunas.substring(0,4) }}</div>
                                            </div>
                                        </div>
                                        <span v-else class="font-bold">--</span>
                                    </div>
                                    <a :href="route('pembelians.show', pembelian.id)" class="text-sky-500">
                                        <div class="min-w-max">
                                            <span v-if="alamats[index]">
                                                {{ pembelian.supplier_nama }} - {{ alamats[index].short }}
                                            </span>
                                            <span v-else>
                                                {{ pembelian.supplier_nama }}
                                            </span>
                                        </div>
                                    </a>
                                    <div v-if="pembelian.keterangan_bayar" class="text-slate-400">( {{ pembelian.keterangan_bayar }} )</div>
                                    <div>
                                        <a :href="route('pembelians.show', pembelian.id)" class="text-indigo-500">{{ pembelian.nomor_nota }}</a>
                                    </div>
                                    <div class="flex justify-between font-semibold">
                                        <span>Rp</span>
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox" />
                            <div class="collapse-title border rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            <div class="collapse-content">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td colspan="4">
                                                <!-- PEMBELIAN_ITEMS -->
                                                <table class="w-full">
                                                    <tr v-for="(pembelian_barang, i_pembelian_barang) in pembelian_barangs_all[index]">
                                                        <td>{{ i_pembelian_barang + 1 }}.</td>
                                                        <td><div class="min-w-max">{{ pembelian_barang.barang_nama }}</div></td>
                                                        <td>
                                                            <div v-if="pembelian_barang.satuan_sub" class="min-w-max">
                                                                {{ pembelian_barang.jumlah_sub / 100 }} {{ pembelian_barang.satuan_sub }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="min-w-max">
                                                                {{ pembelian_barang.jumlah_main / 100 }} {{ pembelian_barang.satuan_main }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="min-w-max">
                                                                Rp {{ pembelian_barang.harga_main }} /{{ pembelian_barang.satuan_main }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="flex justify-between">
                                                                <span>Rp</span>
                                                                {{ pembelian_barang.harga_t }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <form @submit.prevent="submitDeletePembelian">
                                                                <div>
                                                                    <button class="rounded bg-pink-300 text-pink-500">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <div v-if="!pembelians[index].isi">
                                                                Content:
                                                                <span v-for="isi in pembelians[index].isi">
                                                                --> {{ isi.jumlah / 100 }} {{ isi.satuan }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <th>Total</th>
                                                        <td>
                                                            <div class="flex justify-between font-semibold">
                                                                <span>Rp</span>
                                                                {{ pembelians[index].harga_total }}
                                                                <span>,-</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- END - PEMBELIAN_ITEMS -->
                                            </td>
                                            <td class="align-bottom">
                                                <div>
                                                    <a :href="route('pembelians.edit', pembelian.id)">
                                                        <button class="rounded bg-slate-200 text-slate-400">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                </div>
                                                <form @submit.prevent="" onsubmit="return confirm('Yakin ingin menghapus pembelian ini?')">
                                                    <button type="submit" class="text-red-500 bg-red-200 rounded">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                <div>
                                                    <button id="btn_form_pelunasan" class="text-emerald-500 border border-emerald-300 rounded" onclick="toggle_light(this.id, 'form_pelunasan-{{ $i }}', [], ['bg-emerald-200'], 'table-row')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                        
                </tr>
                <!-- <tr class="hidden" id="detail_pembelian-{{ $i }}"> -->
                <!-- <tr :class="show_pembelian_items[index] + 'transition-opacity ease-in-out delay-150 duration-300'"> -->
                
                <!-- FORM PELUNASAN -->
                <tr class="hidden" id="form_pelunasan-{{ $i }}">
                    <td colspan="7">
                        <!-- <form action="{{ route('pembelians.pelunasan', pembelian.id) }}" method="POST" class="flex justify-end"> -->
                        <form @submit.prevent="submitPelunasanPembelian" class="flex justify-end">
                            <table>
                                <tr>
                                    <td>Tanggal Lunas</td><td>:</td>
                                    <td>
                                        <div v-if="pembelians[index].status_bayar === 'LUNAS'" class="flex">
                                            <input type="text" name="day" id="day" class="border rounded text-xs p-1 w-8" placeholder="dd" :value="pembelians[index].tanggal_lunas">
                                            <input type="text" name="month" id="month" class="border rounded text-xs p-1 w-8 ml-1" placeholder="mm" :value="pembelians[index].tanggal_lunas">
                                            <input type="text" name="year" id="year" class="border rounded text-xs p-1 w-11 ml-1" placeholder="yyyy" :value="pembelians[index].tanggal_lunas">
                                        </div>
                                        <div>
                                            <input type="text" name="day" id="day" class="border rounded text-xs p-1 w-8" placeholder="dd" :value="day_now">
                                            <input type="text" name="month" id="month" class="border rounded text-xs p-1 w-8 ml-1" placeholder="mm" :value="month_now">
                                            <input type="text" name="year" id="year" class="border rounded text-xs p-1 w-11 ml-1" placeholder="yyyy" :value="year_now">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td><td>:</td>
                                    <td><textarea name="keterangan_bayar" id="" cols="30" rows="3" class="text-xs p-1">{{ pembelians[index].keterangan_bayar }}</textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="text-end">
                                            <button class="border-2 border-emerald-300 bg-emerald-100 rounded text-emerald-500 px-1">Confirm</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <form @submit.prevent="submitPembatalanPelunasan" class="mt-1">
                            <div class="text-center">
                                <button class="border-2 border-yellow-300 bg-yellow-100 rounded text-yellow-500 px-1">batalkan pelunasan</button>
                            </div>
                        </form>
                    </td>
                </tr>
                <!-- FORM PELUNASAN -->
            </template>
        </tbody>
    </table>
</template>