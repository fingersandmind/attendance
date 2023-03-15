<script setup>
import RightIcon from "@/Components/Icons/RightIcon.vue";
import HomeDarkIcon from "@/Components/Icons/HomeDarkIcon.vue";
import { Link } from "@inertiajs/vue3";

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
            <Link
                :href="breadcrumb.link"
                class="text-gray-400 hover:text-gray-500"
            >
                <HomeDarkIcon class="my-2"/>
                <span class="sr-only">{{ breadcrumb.name }}</span>
            </Link>
        </div>
    </li>
    <li v-else class="flex">
        <div
            class="flex items-center"
            :class="{ 'pointer-events-none' : breadcrumb.link === '#' }"
        >
            <RightIcon />
            <Link
                :disabled="breadcrumb.link === '#'"
                :href="breadcrumb.link"
                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                aria-current="page"
            >
                {{ breadcrumb.name }}
            </Link>
        </div>
    </li>
</template>
