<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/Inputs/InputLabel.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import InputError from "@/Components/Inputs/InputError.vue";
import { Link } from "@inertiajs/vue3";

let props = defineProps({
   faculty: {
       type: Object,
       required: true
   },
   breadcrumbs: Object
});

let form = useForm({
    'title': props.faculty.title,
    'firstname': props.faculty.firstname,
    'middlename': props.faculty.middlename,
    'lastname': props.faculty.lastname,
    'email': props.faculty.email,
    'phone': props.faculty.phone,
    'country': 'Philippines',
    'address': props.faculty.address,
    'position': props.faculty.detail?.position,
    'division': props.faculty.detail?.division,
    'speciality': props.faculty.detail?.speciality,
});
const title = ['Mr.', 'Mrs.', 'Ms.'];

</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <div class="flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <form class="space-y-8 divide-y divide-gray-200" @submit.prevent="form.put(route('admin.faculties.update', { faculty: faculty.id }))">
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div class="">
                                <div>
                                    <h3 class="text-base font-semibold leading-6 text-gray-900">Personal Information</h3>
                                    <p class="mt-1 text-sm text-gray-500">Fill in information below</p>
                                </div>
                                <div class="grid grid-cols-1 mt-6 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="grid grid-cols-1 gap-6 sm:col-span-6 sm:grid-cols-6">

                                        <div class="sm:col-span-1">
                                            <InputLabel
                                                value="Title"
                                                for="title"
                                            />
                                            <div class="mt-1">
                                                <select
                                                    v-model="form.title"
                                                    id="title"
                                                    name="title"
                                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                >
                                                    <option
                                                        v-for="(item, key) in title"
                                                        :key="key"
                                                    >
                                                        {{ item }}
                                                    </option>
                                                </select>
                                                <InputError v-if="form.errors.title" class="mt-1 text-xs text-red-600">
                                                    {{ form.errors.title }}
                                                </InputError>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="First name"
                                            for="first-name"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.firstname"
                                                type="text"
                                                name="first-name"
                                                id="first-name"
                                            />
                                            <InputError
                                                v-if="form.errors.firstname"
                                            >
                                                {{ form.errors.firstname }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="Last name"
                                            for="last-name"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.lastname"
                                                type="text"
                                                name="last-name"
                                                id="last-name"
                                            />
                                            <InputError
                                                v-if="form.errors.lastname"
                                            >
                                                {{ form.errors.lastname }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="Middle name"
                                            for="middle-name"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.middlename"
                                                type="text"
                                                name="middle-name"
                                                id="middle-name"
                                            />
                                            <InputError
                                                v-if="form.errors.middlename"
                                            >
                                                {{ form.errors.middlename }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <InputLabel
                                            value="Email Address"
                                            for="email"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.email"
                                                id="email"
                                                name="email"
                                                type="email"
                                            />
                                            <InputError
                                                v-if="form.errors.email"
                                            >
                                                {{ form.errors.email }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="Position"
                                            for="position"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.position"
                                                type="text"
                                                name="position"
                                                id="position"
                                            />
                                            <InputError
                                                v-if="form.errors.position"
                                            >
                                                {{ form.errors.position }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="Division"
                                            for="division"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.division"
                                                type="text"
                                                name="division"
                                                id="division"
                                            />
                                            <InputError
                                                v-if="form.errors.division"
                                            >
                                                {{ form.errors.division }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="Speciality"
                                            for="speciality"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.speciality"
                                                type="text"
                                                name="speciality"
                                                id="speciality"
                                            />
                                            <InputError
                                                v-if="form.errors.speciality"
                                            >
                                                {{ form.errors.speciality }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="Phone"
                                            for="phone"
                                        />
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.phone"
                                                type="text"
                                                name="phone"
                                                id="phone"
                                            />
                                            <InputError
                                                v-if="form.errors.phone"
                                            >
                                                {{ form.errors.phone }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel
                                            value="Country"
                                            for="country"
                                        />
                                        <div class="mt-1">
                                            <select
                                                v-model="form.country"
                                                id="country"
                                                name="country"
                                                disabled
                                                class="block w-full bg-gray-200 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            >
                                                <option selected>Philippines</option>
                                            </select>
                                            <InputError
                                                v-if="form.errors.country"
                                            >
                                                {{ form.errors.country }}
                                            </InputError>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <InputLabel
                                            value="Address"
                                            for="address"
                                        />
                                        <div class="mt-1">
                                            <textarea
                                                v-model="form.address"
                                                type="text"
                                                name="street-address"
                                                id="street-address"
                                                class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            ></textarea>
                                            <InputError
                                                v-if="form.errors.address"
                                            >
                                                {{ form.errors.address }}
                                            </InputError>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <Link
                                    :href="route('admin.faculties.show', { faculty: faculty.id })"
                                    type="button"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
