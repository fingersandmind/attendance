
<script setup>
import { computed, ref, onMounted } from 'vue';
import EllipsisHorizontal from '@/Components/Icons/EllipsisHorizontal.vue';
import Chevron from '@/Components/Icons/Chevron.vue';

const props = defineProps({
    links: {
        type: Object,
        default: () => ({})
    }
});

const links = ref(props.links)

const emit = defineEmits(['page-changed']);

const nthPage = computed(() => Math.ceil(links.value.last_page / 2));

const pages = computed(() => {
    const pages = [];
    let ellipsisAdded = false;

    for (let i = 1; i <= links.value.last_page; i++) {
        if (
            i === 1 || 
            i === links.value.last_page || 
            (i >= links.value.current_page - 2 && i <= links.value.current_page + 2)
        ) {
            pages.push({
                page: i,
                label: i,
                active: i === links.value.current_page
            });
        } else if (
            (i === links.value.current_page - 3 || i === links.value.current_page + 3) && 
            !ellipsisAdded
        ) {
            pages.push({ label: '...' });
            ellipsisAdded = true;
        }
    }

    return pages;
});

const goToPage = (page) => {
    emit('page-changed', page);
};
</script>

<template>
    <div v-if="links" class="grid items-center grid-cols-3 mt-8 columns-auto font-source">
        <div class="pl-5 text-sm text-dark-gray-900">
            Showing
            <span class="font-semibold">{{ links.from }}</span>
            to
            <span class="font-semibold">{{ links.to }}</span>
            of
            <span class="font-semibold">{{ links.total }}</span>
            results
        </div>
        <nav class="inline-flex items-center justify-center gap-4" aria-label="Pagination">
            <div v-for="(link, index) in pages" :key="index" class="flex items-center">
                <button
                    v-if="index === 0"
                    class="relative items-center mr-2 pagination-link"
                    @click="goToPage(link.page)">
                    <Chevron :size="5" direction="left" fill="text-dark-gray-900" />
                </button>
                <button
                    v-if="link.page"
                    aria-current="page"
                    class="py-1.5 px-3 inline-block text-center text-sm border pagination-link"
                    :class="link.active ? 'text-white border-transparent bg-blue-400' : 'text-dark-gray-900 border border-slate-300'"
                    @click="goToPage(link.page)">
                    {{ link.label }}
                </button>
                <EllipsisHorizontal v-if="link.label === '...'" class="pagination-link" />
                <button
                    v-if="link.page && index === pages.length - 1"
                    class="relative items-center ml-2 pagination-link"
                    @click="goToPage(link.page)">
                    <Chevron :size="5" direction="right" fill="text-dark-gray-900" />
                </button>
            </div>
        </nav>
    </div>
</template>
