<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import InputLabel from "@/Components/Inputs/InputLabel.vue";
import InputError from "@/Components/Inputs/InputError.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import { ref } from "vue";
import {useForm} from "@inertiajs/vue3";

const defaultClass = ref("" +
    "block w-full flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 " +
    "ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 " +
    "focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
);

let props = defineProps({
   setting: Object
});

const form = useForm({
   firstIn: props.setting.first_in,
   firstOut: props.setting.first_out,
   secondIn: props.setting.second_in,
   secondOut: props.setting.second_out
});

// function submit(){
//     ax
// }

</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs />
        <div class="px-4 sm:px-6 lg:px-8">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Attendance settings</h3>
                            <p class="mt-1 text-sm text-gray-600">Update your attendance log time</p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form @submit.prevent="form.post(route('admin.settings.store'))">
                            <div class="shadow sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="">
                                            <InputLabel
                                                value="Morning"
                                                for="first-in"
                                            />
                                            <div class="mt-2 flex rounded-md">
                                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 px-3 text-gray-500 sm:text-sm w-12">In:</span>
                                                <TextInput
                                                    :default-class="defaultClass"
                                                    type="time"
                                                    v-model="form.firstIn" />
                                                <InputError
                                                    v-if="form.errors.firstIn"
                                                >
                                                    {{ form.errors.firstIn }}
                                                </InputError>
                                            </div>
                                            <div class="mt-2 flex rounded-md">
                                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 px-3 text-gray-500 sm:text-sm w-12">Out:</span>
                                                <TextInput
                                                    :default-class="defaultClass"
                                                    type="time"
                                                    v-model="form.firstOut" />
                                            </div>
                                        </div>
                                        <div class="">
                                            <InputLabel
                                                value="Afternoon"
                                                for="first-in"
                                            />
                                            <div class="mt-2 flex rounded-md">
                                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 px-3 text-gray-500 sm:text-sm w-12">In:</span>
                                                <TextInput
                                                    :default-class="defaultClass"
                                                    type="time"
                                                    v-model="form.secondIn" />
                                            </div>
                                            <div class="mt-2 flex rounded-md">
                                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 px-3 text-gray-500 sm:text-sm w-12">Out:</span>
                                                <TextInput
                                                    :default-class="defaultClass"
                                                    type="time"
                                                    v-model="form.secondOut" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0 hidden">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Attendance RFID Data</h3>
                            <p class="mt-1 text-sm text-gray-600">Import your attendance data from RFID using excel format</p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                                            <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                                            <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="email-address" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                            <input type="text" name="email-address" id="email-address" autocomplete="email" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                            <select id="country" name="country" autocomplete="country-name" class="mt-2 block w-full rounded-md border-0 bg-white py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option>United States</option>
                                                <option>Canada</option>
                                                <option>Mexico</option>
                                            </select>
                                        </div>

                                        <div class="col-span-6">
                                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                                            <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                            <input type="text" name="city" id="city" autocomplete="address-level2" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="region" class="block text-sm font-medium leading-6 text-gray-900">State / Province</label>
                                            <input type="text" name="region" id="region" autocomplete="address-level1" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                                            <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0 hidden">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Update Calendar Holidays or Special Events</h3>
                            <p class="mt-1 text-sm text-gray-600">Decide which communications you'd like to receive and how.</p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <fieldset>
                                        <legend class="sr-only">By Email</legend>
                                        <div class="text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">By Email</div>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-start">
                                                <div class="flex h-6 items-center">
                                                    <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                </div>
                                                <div class="ml-3">
                                                    <label for="comments" class="text-sm font-medium leading-6 text-gray-900">Comments</label>
                                                    <p class="text-sm text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start">
                                                <div class="flex h-6 items-center">
                                                    <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                </div>
                                                <div class="ml-3">
                                                    <label for="candidates" class="text-sm font-medium leading-6 text-gray-900">Candidates</label>
                                                    <p class="text-sm text-gray-500">Get notified when a candidate applies for a job.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start">
                                                <div class="flex h-6 items-center">
                                                    <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                </div>
                                                <div class="ml-3">
                                                    <label for="offers" class="text-sm font-medium leading-6 text-gray-900">Offers</label>
                                                    <p class="text-sm text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend class="contents text-sm font-semibold leading-6 text-gray-900">Push Notifications</legend>
                                        <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <input id="push-everything" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="push-everything" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Everything</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="push-email" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="push-email" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Same as email</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="push-nothing" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="push-nothing" class="ml-3 block text-sm font-medium leading-6 text-gray-900">No push notifications</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </AuthenticatedLayout>
</template>
