<script setup>
defineProps({
    log: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <li>
        <a href="#" class="block pointer-events-none hover:bg-gray-50">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="flex-1 min-w-0 sm:flex sm:items-center sm:justify-between">
                    <div class="w-full truncate">
                        <div class="flex items-center justify-between text-sm">
                            <p class="font-medium text-indigo-600 truncate">{{ log.user.name }}</p>
                            <p class="flex-shrink-0 ml-1 font-normal text-gray-500">Attempts: {{ log.attempts }}</p>
                        </div>
                        <div class="flex justify-end mt-2">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                </svg>
                                <p>
                                    Date:
                                    <time datetime="2020-01-07">{{ new Date(log.created_at).toDateString() }}</time>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </li>
</template>
