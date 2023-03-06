<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true
    },
    type: {
        type: String,
        required: false,
        default: 'text'
    },
    placeholder: {
        type: String,
        default: ''
    },
    preIcon: {
        type: Object,
        default: null
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <div class="relative">
        <div
            v-if="preIcon"
            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
            <component :is="preIcon" v-if="preIcon" class="mr-4" />
        </div>
        <input
            ref="input"
            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            :class="preIcon ? 'pl-10' : ''"
            :placeholder="placeholder"
            :value="modelValue"
            :type="type"
            @input="$emit('update:modelValue', $event.target.value)" />
    </div>
</template>
