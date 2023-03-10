<script setup>

import {useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import InputLabel from "@/Components/Inputs/InputLabel.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import InputError from "@/Components/Inputs/InputError.vue";
import { Link } from "@inertiajs/vue3";

let form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs />

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <form class="space-y-6" @submit.prevent="form.post(route('admin.users.store'))">
                            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    <div class="md:col-span-1">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900">Personal Information</h3>
                                        <p class="mt-1 text-sm text-gray-500">Use a permanent address where you can receive mail.</p>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end px-4 sm:px-0">
                                <Link
                                    :href="route('admin.users.index')"
                                    class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="ml-3 inline-flex justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
