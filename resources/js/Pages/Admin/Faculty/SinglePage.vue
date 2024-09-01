<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import PaperClipIcon from "@/Components/Icons/PaperClipIcon.vue";
import AttendanceTable from "@/Components/Tables/AttendanceTable.vue";
import { Link } from "@inertiajs/vue3";
import html2pdf from "html2pdf.js";
import AvatarIcon from "@/Components/Icons/AvatarIcon.vue";

let props = defineProps({
   faculty: {
       type: Object,
       required: true
   },
   attendances: Object,
   setting: Object,
   breadcrumbs: Object
});
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
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <div class="mb-4 overflow-hidden bg-white border shadow sm:rounded-lg">
            <div class="flex items-start justify-between">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Faculty Information</h3>
                    <p class="max-w-2xl mt-1 text-sm text-gray-500">Personal details</p>
                </div>
                <Link
                    :href="route('admin.faculties.edit', { faculty:faculty.id })"
                    class="px-4 py-2 m-4 text-white bg-blue-400 rounded-md">
                    Update
                </Link>
            </div>
            <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
                <div>
                    <div class="flex items-center mb-4">
                        <span class="inline-block w-16 h-16 overflow-hidden bg-gray-100 rounded-full">
                          <AvatarIcon />
                        </span>
                    </div>
                </div>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Full name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ faculty.fullname }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Position</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ faculty.detail.position }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Speciality</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ faculty.detail.speciality }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Division</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ faculty.detail.division }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ faculty.email }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ faculty.phone }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Country</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ faculty.country }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ faculty.address }}
                        </dd>
                    </div>
                    <div v-if="attendances.data.length > 0" class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul role="list" class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex items-center flex-1 w-0">
                                        <PaperClipIcon class="flex-shrink-0 w-5 h-5 text-gray-400" aria-hidden="true" />
                                        <span class="flex-1 w-0 ml-2 truncate">{{ faculty.lastname }}_attendance_log.pdf</span>
                                    </div>
                                    <div class="flex-shrink-0 ml-4">
                                        <button @click="exportToPdf" class="font-medium text-indigo-600 hover:text-indigo-500">Download</button>
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <div
            v-if="attendances.data.length > 0"
            class="flex items-center justify-between w-full px-8">
            <h2
                class="my-4 text-sm font-medium text-gray-500">
                Recent logs
            </h2>
            <Link
                :href="route('admin.logs.show', { faculty: faculty.id })"
                class="block rounded-md bg-indigo-600 py-1.5 px-3 text-center text-sm font-semibold
                            leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline
                            focus-visible:outline-2 focus-visible:outline-offset-2
                            focus-visible:outline-indigo-600"
            >
                See detailed logs
            </Link>
        </div>
        <div
            v-if="attendances.data.length > 0"
            class="overflow-hidden bg-white border shadow sm:rounded-lg">
            <AttendanceTable
                :has-pagination="true"
                :table-id="'attendance-table'"
                :attendances="attendances"
                :user="faculty.fullname"
                :setting="setting"
            />
        </div>
    </AuthenticatedLayout>
</template>
