<script setup>
import Pagination from "@/Components/Pagination/Pagination.vue";
import {router } from "@inertiajs/vue3";

let props = defineProps({
    user: String,
    attendances: Object,
    setting: {
      type: Object,
      required: true
    },
    totalLoggedHours: String,
    totalLateHours: String,
    tableId: String,
    editable: true,
    hasPagination: true
});

let status = (time) => {
    time = simplifyTime(time);
    let fIn = simplifyTime(props.setting.first_in);
    let fOut = simplifyTime(props.setting.first_out);
    let sIn = simplifyTime(props.setting.second_in);
    let sOut = simplifyTime(props.setting.second_out);
    let isLate = (time > fIn && time < fOut) || (time > sIn && time < sOut);
    return isLate ? 'text-red-500' : 'text-green-500'
}

function simplifyTime(time)
{
    time = time.substring(0,5);
    return parseInt(time.replace(':',''));
}

let search = (page = 1) => {
    let url = props.attendances.next_page_url;
    if ( url != null )
    {
        router.visit(url,{
            data: {
                page: page
            },
            preserveScroll: true,
            only: ['attendances', 'totalLoggedHours']
        })
    }
}
</script>

<template>
    <div class="px-4 my-4">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold leading-6 text-center text-gray-900">Attendance Table</h1>
                <p class="hidden mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
            </div>
            <div class="hidden mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button type="button" class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button>
            </div>
            <slot/>
        </div>
        <div
            class="mt-8 -mx-4 sm:-mx-0" :id="tableId">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
        <thead class="bg-gray-50">
            <tr>
                <th
                    scope="col"
                    class="px-4 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase border-b border-gray-200"
                >
                    Name
                </th>
                <th
                    scope="col"
                    class="px-4 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase border-b border-gray-200"
                >
                    AM In
                </th>
                <th
                    scope="col"
                    class="px-4 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase border-b border-gray-200"
                >
                    AM Out
                </th>
                <th
                    scope="col"
                    class="px-4 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase border-b border-gray-200"
                >
                    PM In
                </th>
                <th
                    scope="col"
                    class="px-4 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase border-b border-gray-200"
                >
                    PM Out
                </th>
                <th
                    scope="col"
                    class="px-4 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase border-b border-gray-200"
                >
                    Date
                </th>
                <th
                    v-if="editable"
                    scope="col"
                    class="px-4 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase border-b border-gray-200"
                >
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <tr
                v-for="attendance in attendances.data"
                :key="attendance.id"
                class="transition duration-150 hover:bg-gray-50"
            >
                <td class="px-4 py-4 text-sm font-medium text-gray-900">
                    {{ user ?? attendance.faculty.fullname }}
                </td>
                <td
                    class="px-4 py-4 text-sm text-center lg:table-cell"
                    :class="status(attendance.first_in)"
                >
                    {{ attendance.first_in }}
                </td>
                <td class="px-4 py-4 text-sm text-center lg:table-cell">
                    {{ attendance.first_out }}
                </td>
                <td
                    class="px-4 py-4 text-sm text-center lg:table-cell"
                    :class="status(attendance.second_in)"
                >
                    {{ attendance.second_in }}
                </td>
                <td class="px-4 py-4 text-sm text-center lg:table-cell">
                    {{ attendance.second_out }}
                </td>
                <td class="px-4 py-4 text-sm text-center lg:table-cell">
                    {{ new Date(attendance.created_at).toDateString() }}
                </td>
                <td
                    v-if="editable"
                    class="px-4 py-4 text-sm font-medium text-right text-indigo-600 transition duration-150 hover:text-indigo-900"
                >
                    <a href="#">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
            <div v-show="totalLoggedHours" class="flex justify-start gap-4 my-8">
                <span class="block text-gray-500 text-md">Total Logged Hours: {{ totalLoggedHours }}</span>
                <span class="block text-red-500 text-md">Total Late Hours: {{ totalLateHours }}</span>
            </div>
        </div>
        <Pagination
            v-if="hasPagination"
            :links="attendances"
            @page-changed="search"
        />
    </div>

</template>
