<script setup>
import TabButton from './TabButton.vue';

const props = defineProps({
    tabs: Array,
    titles: Array,
});

// console.log(props.tabs);
</script>

<template>
    <div class="grid">
        <div class="tabs tabs-lifted z-10 -mb-[var(--tab-border)] justify-self-start">
            <TabButton v-for="(tab,i) in props.tabs" :href="route(tab)" :active="route().current(tab)">{{ props.titles[i] }}</TabButton>
            <!-- <TabButton :href="route('pembelians.index')" :active="route().current('pembelians.index')">Pembelian</TabButton>
            <TabButton :href="route('barangs.index')" :active="route().current('barangs.index')">Barang</TabButton> -->
            <!-- <button class="tab tab-active [--tab-bg:var(--fallback-b1,oklch(var(--b1)]">Preview</button>
            <button class="tab [--tab-border-color:transparent]">HTML</button>
            <button class="tab [--tab-border-color:transparent]">JSX</button> -->
            <div class="tab [--tab-border-color:transparent]"></div>
        </div>
        <div class="bg-base-300 rounded-b-box rounded-se-box relative overflow-x-auto">
            <div class="preview border-base-300 bg-base-100 rounded-b-box rounded-se-box min-h-[6rem] min-w-[18rem] overflow-x-hidden bg-cover bg-top p-4 [border-width:var(--tab-border)]" style="">
                <!-- <div class="drawer h-56 rounded overflow-hidden">
                    <input id="my-drawer" type="checkbox" class="drawer-toggle"> 
                    <div class="flex flex-col items-center justify-center drawer-content">
                        <label for="my-drawer" class="btn btn-primary drawer-button">Open drawer</label>
                    </div> <div class="drawer-side h-full absolute">
                        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label> 
                        <ul class="menu p-4 w-60 md:w-80 min-h-full bg-base-200 text-base-content">
                            <li><button>Sidebar Item 1</button></li> 
                            <li><button>Sidebar Item 2</button></li>
                        </ul>
                    </div>
                </div> -->
                <slot />
            </div>
        </div>
    </div>
</template>