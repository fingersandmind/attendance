<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/Inputs/TextInput.vue";
import InputLabel from "@/Components/Inputs/InputLabel.vue";
import InputError from "@/Components/Inputs/InputError.vue";
import {ref} from "vue";

let props = defineProps({
    user: {
        type: Object,
        required: true
    },
});

const toggleForm = ref(false);

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: null,
    password_confirmation: null
});

function submit() {
    form.put(route('admin.users.update', { user: props.user.id }));
    toggleForm.value = false;
}

let showForm = () => {
    toggleForm.value = !toggleForm.value;
}
</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs />
        <div class="overflow-hidden bg-white shadow sm:rounded-lg mx-8 border mb-4">
            <div class="flex justify-between items-start">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">User's Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Details</p>
                </div>
                <button
                    class="px-4 py-2 bg-blue-400 text-white rounded-md m-4"
                    @click="showForm"
                    v-text="toggleForm ? 'Cancel' : 'Update'"
                />
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Full name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ user.name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ user.email }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div v-show="toggleForm" class="px-4 sm:px-6 lg:px-8">
            <div class="flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <form class="space-y-6" @submit.prevent="submit">
                            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    <div class="md:col-span-1">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900">Update Details</h3>
                                        <p class="mt-1 text-sm text-gray-500">Fill in details to update</p>
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
                                                    placeholder="password"
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
                                                    placeholder="confirm password"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end px-4 sm:px-0">
                                <button
                                    @click="toggleForm = false"
                                    type="button"
                                    class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</button>
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
