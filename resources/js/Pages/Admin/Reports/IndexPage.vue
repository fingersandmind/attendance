<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Logs from "@/Pages/Admin/Reports/Logs.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";

defineProps({
    logs: {
        type: Object,
        required: true
    },
    breadcrumbs: Object
});
</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
        <div class="w-full">
            <div class="flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                            <div class="flex flex-col">
                                <div class="md:col-span-1">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900">Log Attempts</h3>
                                    <p class="mt-1 text-sm text-gray-500">Recent logs from users</p>
                                </div>
                                <div class="mt-4 overflow-hidden bg-white shadow sm:rounded-md">
                                    <Logs :logs="logs" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
