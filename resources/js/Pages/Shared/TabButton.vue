<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
})
const classes = computed(()=>props.active
    ? "tab tab-active [--tab-bg:var(--fallback-b1,oklch(var(--b1)]"
    : "tab [--tab-border-color:transparent]"
);

</script>
<template>
    <button :class="classes">
        <Link :href="props.href">
            <slot />
        </Link>
    </button>
</template>