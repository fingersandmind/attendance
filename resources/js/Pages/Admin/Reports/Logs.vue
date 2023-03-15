<script setup>
import LogItem from "@/Pages/Admin/Reports/LogItem.vue";

defineProps({
    logs: Object
})
</script>

<template>
    <ul role="list" class="divide-y divide-gray-200">
        <LogItem
            v-for="log in logs"
            :key="log.id"
            :log="log"
        />
    </ul>
</template>
