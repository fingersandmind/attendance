<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";

</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs />
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
            <!-- Replace with your content -->
            <div class="py-4">
                <div class="h-96 rounded-lg border-4 border-dashed border-gray-200"></div>
            </div>
            <!-- /End replace -->
        </div>
    </AuthenticatedLayout>
</template>
