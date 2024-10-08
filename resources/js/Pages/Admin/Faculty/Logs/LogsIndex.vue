<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import AttendanceTable from "@/Components/Tables/AttendanceTable.vue";
import PaperClipIcon from "@/Components/Icons/PaperClipIcon.vue";
import { ref, onMounted } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/src/VueDatePicker/style/main.scss';
import { router } from "@inertiajs/vue3";
import html2pdf from "html2pdf.js";

const date = ref([]);
let props = defineProps({
    attendances: Object,
    faculty: Object,
    dates: Array,
    totalLoggedHours: String,
    totalLateHours: String,
    setting: Object
})

onMounted(() => {
   date.value = props.dates;
});

const handleDate = (modelData) => {
    date.value = modelData;
    let url = route('admin.logs.show', { faculty: props.faculty.id });
    router
        .visit(url, {
            data: {
                dates: date.value
            },
            only: ['attendances','dates', 'totalLateHours', 'totalLoggedHours'],
            preserScroll: true
        });
}

const clearFilter = () => {
    data.value = [];
}

const filename = `${props.faculty.firstname}_attendance_log.pdf`;
let exportToPdf = () => {
    html2pdf(document.getElementById('attendance-table'), {
        margin: 4,
        filename: filename
    })
}

</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs />
        <section class="flex flex-col w-1/2 gap-2">
            <p class="block text-gray-800 text-md">Select dates</p>
            <VueDatePicker
                v-model="date"
                range
                @update:model-value="handleDate"
                @cleared="clearFilter"
            />
        </section>
        <div class="mx-8 mt-8 mb-4 overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                <div class="flex items-center flex-1 w-0">
                    <PaperClipIcon class="flex-shrink-0 w-5 h-5 text-gray-400" aria-hidden="true" />
                    <span class="flex-1 w-0 ml-2 truncate">{{ faculty.lastname }}_attendance_log.pdf</span>
                </div>
                <div class="flex-shrink-0 ml-4">
                    <button @click="exportToPdf" class="font-medium text-indigo-600 hover:text-indigo-500">Download</button>
                </div>
            </div>
            <AttendanceTable
                v-if="attendances.data.length > 0"
                :table-id="'attendance-table'"
                :attendances="attendances"
                :total-logged-hours="totalLoggedHours"
                :total-late-hours="totalLateHours"
                :setting="setting"
                :editable="false"
                :has-pagination="false"
                :user="faculty.fullname"
            />
        </div>
    </AuthenticatedLayout>
</template>
