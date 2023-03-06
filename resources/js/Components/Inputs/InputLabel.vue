<script setup>
defineProps({
    value: {
        type: String,
        required: false
    }
});
</script>

<template>
    <label class="block text-sm font-medium leading-6 text-gray-900">
        <span v-if="value" class="mb-2 block">{{ value }}</span>
        <span v-else class="mb-2 block"><slot /></span>
    </label>
</template>
