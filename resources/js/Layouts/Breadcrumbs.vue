<script setup>
import RightIcon from "@/Components/Icons/RightIcon.vue";
import HomeDarkIcon from "@/Components/Icons/HomeDarkIcon.vue";
import BreadcrumbItem from "@/Layouts/BreadcrumbItem.vue";

const breadcrumbs = [
    {
        link: "#",
        icon: HomeDarkIcon,
        name: "Home"
    },
    {
        link: "#",
        icon: RightIcon,
        name: "Projects"
    },
    {
        link: "#",
        icon: RightIcon,
        name: "Some Item"
    },
];

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
