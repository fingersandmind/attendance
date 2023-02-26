<script setup>

defineProps({
    menu: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md"
        :class="{ 'bg-gray-900 text-white' : menu.active, 'text-gray-300' : !menu.active }"
    >
        <!-- Current: "", Default: "text-gray-400 group-hover:text-gray-300" -->
        <component :is="menu.icon" />
        {{ menu.name }}
    </a>
</template>
