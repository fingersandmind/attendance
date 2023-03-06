<script setup>
defineProps({
    message: String
});
</script>

<template>
    <div v-show="message">
        <p class="text-red-600 mt-1 text-xs">
            {{ message }}
        </p>
    </div>
</template>
