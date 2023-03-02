<script setup>
import { computed } from 'vue';
const props = defineProps({
    direction: {
        type: String,
        default: 'down'
    },
    size: {
        // size based on tailwind height & weight classes
        type: Number,
        default: 6
    },
    fill: {
        // based on tailwind text color classes
        type: String,
        default: 'text-black'
    }
});

const direction = computed(() => {
    if (props.direction === 'up') {
        return 'rotate-180';
    } else if (props.direction === 'right') {
        return 'rotate-[-90deg]';
    } else if (props.direction === 'left') {
        return 'rotate-90';
    } else {
        return '';
    }
});
</script>
<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        :class="[direction, 'w-' + size, 'h-' + size, fill]">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
    </svg>
</template>
