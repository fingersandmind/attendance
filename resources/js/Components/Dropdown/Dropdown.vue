<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
const props = defineProps({
    align: {
        type: String,
        default: 'right'
    },
    width: {
        type: String,
        default: '48'
    }
});
const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};
onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));
const widthClass = computed(() => {
    return {
        48: 'w-48'
    }[props.width.toString()];
});
const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'origin-top-left left-0';
    } else if (props.align === 'right') {
        return 'origin-top-right right-0';
    } else {
        return 'origin-top';
    }
});
const open = ref(false);
</script>

<template>
    <div class="relative">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div
            v-show="open"
            class="fixed inset-0 z-40"
            @click="open = false"></div>

        <transition
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0">
            <div
                v-show="open"
                class="absolute z-50 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                :class="[widthClass, alignmentClasses]"
                aria-label="submenu"
                @click="open = false"
                @keyup.esc="open = false">
                <slot name="content" />
            </div>
        </transition>
    </div>
</template>
