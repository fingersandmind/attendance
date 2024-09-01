<script setup>
import BreadcrumbItem from "@/Layouts/BreadcrumbItem.vue";

defineProps({
   breadcrumbs: Object
});

</script>
<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="flex px-6 mb-8 space-x-4 bg-white rounded-md shadow">
            <BreadcrumbItem
                v-for="item in breadcrumbs"
                :key="item.name"
                :breadcrumb="item"
            />
        </ol>
    </nav>

</template>
