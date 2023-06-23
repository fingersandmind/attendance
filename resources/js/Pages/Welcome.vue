<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AttendanceTable from "@/Components/Tables/AttendanceTable.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";

let props = defineProps({
   attendances: Object,
   setting: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs />
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </div>
        <div class="flex-col px-4 mx-auto mt-4 space-y-4 max-w-7xl sm:px-6 md:px-8">
            <span class="inline-flex rounded-md shadow-sm isolate">
                <a :href="route('admin.export.attendances')" target="_blank" class="relative inline-flex items-center gap-x-1.5 rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                    <svg class="-ml-0.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 001.075.676L10 15.082l5.925 2.844A.75.75 0 0017 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0010 2z" clip-rule="evenodd" />
                    </svg>
                    Export Attendance Log
                </a>
            </span>

            <div
                v-if="attendances.data.length > 0"
                class="mx-8 overflow-hidden bg-white border shadow sm:rounded-lg">
                <AttendanceTable
                    :has-pagination="true"
                    :table-id="'attendance-table'"
                    :attendances="attendances"
                    :setting="setting"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
