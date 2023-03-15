<script setup>
import BreadcrumbItem from "@/Layouts/BreadcrumbItem.vue";

defineProps({
   breadcrumbs: Object
});

</script>
<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="flex space-x-4 rounded-md bg-white px-6 shadow mx-8 mb-8">
            <BreadcrumbItem
                v-for="item in breadcrumbs"
                :key="item.name"
                :breadcrumb="item"
            />
        </ol>
    </nav>

</template>
