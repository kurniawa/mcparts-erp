<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

let session_class = ref('');
let show_session = ref(false);
const page = usePage();

const flash = computed(() => {
  return page.props.session;
})

watch([flash], () => {
    // console.log(flash);
    if (show_session.value) {
        toggleFeedbackMessages();
    }
});

// setInterval(() => {
//     console.log(success_message);
//     console.log(success_message.value);
// }, 5000);

const toggleFeedbackMessages = () => {
    show_session.value = !show_session.value;
    if (show_session.value) {
        session_class.value = 'transform scale-0 '
    } else {
        session_class.value = '';
    }
}
</script>

<template>
    <div id="feedback-messages" class="fixed bottom-10 text-sm z-40" v-if="page.props.session">
        <!-- He who is contented is rich. - Laozi -->
        <div v-if="page.props.session.success_" :class="session_class + 'transition-all duration-500 ease-in-out animate-pulse font-semibold px-3 py-2 rounded bg-emerald-200 text-emerald-600 opacity-70 w-11/12 flex justify-between items-center'">
            <div class="whitespace-nowrap">
                {{ page.props.session.success_ }}
            </div>
            <div>
                <button type="button" @click="toggleFeedbackMessages">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div v-if="page.props.session.warnings_" :class="session_class + 'transition-all duration-500 ease-in-out animate-pulse font-semibold px-3 py-2 rounded bg-yellow-200 text-yellow-600 opacity-70 w-11/12 flex justify-between items-center'">
            <div class="whitespace-nowrap">
                {{ page.props.session.warnings_ }}
            </div>
            <div>
                <button type="button" @click="toggleFeedbackMessages">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div v-if="page.props.session.errors_" :class="session_class + 'transition-all duration-500 ease-in-out animate-pulse font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 w-11/12 flex justify-between items-center'">
            <div class="whitespace-nowrap">
                {{ page.props.session.errors_ }}
            </div>
            <div>
                <button type="button" @click="toggleFeedbackMessages">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- @if (session()->has('errors_') && session('errors_')!=="")
        <div class="font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 w-11/12 flex justify-between items-center">
            <div class="whitespace-nowrap">
                {{ session('errors_') }}
            </div>
            <div>
                <button type="button" @click="toggleFeedbackMessages">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        @endif
        @if (session()->has('failed_') && session('failed_')!=="")
        <div class="font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 w-11/12 flex justify-between items-center">
            <div class="whitespace-nowrap">
                {{ session('failed_') }}
            </div>
            <div>
                <button type="button" @click="toggleFeedbackMessages">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        @endif -->
    </div>
</template>