<script setup>

import {useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import InputLabel from "@/Components/Inputs/InputLabel.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import InputError from "@/Components/Inputs/InputError.vue";
import { Link } from "@inertiajs/vue3";
defineProps({
    breadcrumbs: Object
})
let form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <form class="space-y-6" @submit.prevent="form.post(route('admin.users.store'))">
                            <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    <div class="md:col-span-1">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900">Admin Access</h3>
                                        <p class="mt-1 text-sm text-gray-500">Be sure you allow this user to gain access on everything in this system.</p>
                                    </div>
                                    <div class="mt-5 md:col-span-2 md:mt-0">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <InputLabel value="Fullname"/>
                                                <TextInput
                                                    v-model="form.name"
                                                    name="fullname"
                                                    type="text"
                                                    required
                                                />
                                                <InputError
                                                    v-if="form.errors.name"
                                                    :message="form.errors.name"
                                                />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4">
                                                <InputLabel value="Email"/>
                                                <TextInput
                                                    v-model="form.email"
                                                    name="email"
                                                    type="email"
                                                    required
                                                />
                                                <InputError
                                                    v-if="form.errors.email"
                                                    :message="form.errors.email"
                                                />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4">
                                                <InputLabel value="Password"/>
                                                <TextInput
                                                    v-model="form.password"
                                                    name="password"
                                                    type="password"
                                                    required
                                                />
                                                <InputError
                                                    v-if="form.errors.password"
                                                    :message="form.errors.password"
                                                />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4">
                                                <InputLabel value="Password Confirmation"/>
                                                <TextInput
                                                    v-model="form.password_confirmation"
                                                    name="password_confirmation"
                                                    type="password"
                                                    required
                                                />
                                                <InputError
                                                    v-if="form.errors.password"
                                                    :message="form.errors.password"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end px-4 sm:px-0">
                                <Link
                                    :href="route('admin.users.index')"
                                    class="px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="inline-flex justify-center px-3 py-2 ml-3 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
