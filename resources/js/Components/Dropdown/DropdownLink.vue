<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        default: null
    },
    active: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <div class="flex">
        <Link
            :href="href"
            v-bind="$attrs"
            class="inline-flex items-center w-full px-2 py-2 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
            <slot />
        </Link>
    </div>
</template>
