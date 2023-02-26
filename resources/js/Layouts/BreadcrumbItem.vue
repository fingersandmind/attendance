<script setup>

defineProps({
   breadcrumb: {
       type: Object,
       required: true
   }
});
</script>
<template>
    <li class="flex" v-if="breadcrumb.name === 'Home'">
        <div class="flex items-center">
            <a href="{{ breadcrumb.link }}" class="text-gray-400 hover:text-gray-500">
                <component :is="breadcrumb.icon" />
                <span class="sr-only">{{ breadcrumb.name }}</span>
            </a>
        </div>
    </li>
    <li v-else class="flex">
        <div class="flex items-center">
            <component :is="breadcrumb.icon" />
            <a href="{{ breadcrumb.link }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">
                {{ breadcrumb.name }}
            </a>
        </div>
    </li>
</template>
