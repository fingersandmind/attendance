<script setup>
import Pagination from "@/Components/Pagination/Pagination.vue";
import {router} from "@inertiajs/vue3";
import {onMounted} from "vue";

let props = defineProps({
    user: String,
    attendances: Object,
    tableId: String,
    editable: true,
    hasPagination: true
});

let search = (page = 1) => {
    let url = props.attendances.next_page_url;
    if ( url != null )
    {
        router.visit(url,{
            data: {
                page: page
            },
            preserveScroll: true,
            only: ['attendances']
        })
    }
    // router.
}
</script>

<template>
    <div class="px-4 sm:px-6 lg:px-8 my-4">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold leading-6 text-gray-900 text-center">Attendance Table</h1>
                <p class="hidden mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none hidden">
                <button type="button" class="block rounded-md bg-indigo-600 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button>
            </div>
            <slot/>
        </div>
        <div
            class="-mx-4 mt-8 sm:-mx-0" :id="tableId">
            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">In</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Out</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Date</th>
                    <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Status</th>
                    <th v-if="editable" scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr
                    v-for="attendance in attendances.data"
                    :key="attendance.id"
                >
                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                        {{ user }}
                    </td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ attendance.in }}</td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ attendance.out }}</td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ new Date(attendance.created_at).toDateString() }}</td>
                    <td class="px-3 py-4 text-sm text-gray-500">late</td>
                    <td v-if="editable" class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                    </td>
                </tr>

                <!-- More people... -->
                </tbody>
            </table>
        </div>
        <Pagination
            v-if="hasPagination"
            :links="attendances"
            @page-changed="search"
        />
    </div>

</template>
