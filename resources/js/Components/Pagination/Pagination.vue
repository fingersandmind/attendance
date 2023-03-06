<template>
    <div
        v-if="links"
        class="grid grid-cols-3 columns-auto font-source mt-8 items-center">
        <div class="text-sm text-dark-gray-900 pl-5">
            Showing
            <span class="font-semibold">{{ links.from }}</span>
            to
            <span class="font-semibold">{{ links.to }}</span>
            of
            <span class="font-semibold">{{ links.total }}</span>
            results
        </div>
        <nav
            class="inline-flex items-center justify-center gap-4"
            aria-label="Pagination">
            <div v-for="(link, index) in pages" :key="index" class="flex items-center">
                <button
                    v-if="index === 0"
                    class="relative pagination-link mr-2 items-center"
                    @click="goToPage(link.page)">
                    <Chevron
                        :size="5"
                        direction="left"
                        fill="text-dark-gray-900 " />
                </button>
                <button
                    v-if="link.page"
                    aria-current="page"
                    class="py-1.5 px-3 inline-block text-center text-sm border pagination-link"
                    :class="
                        link.active
                            ? 'text-white border-transparent bg-blue-400'
                            : 'text-dark-gray-900 border border-slate-300'
                    "
                    @click="goToPage(link.page)">
                    {{ link.label }}
                </button>
                <EllipsisHorizontal
                    v-if="link.label === '...'"
                    class="pagination-link" />
                <button
                    v-if="link.page && index === pages.length - 1"
                    class="relative pagination-link ml-2 items-center"
                    @click="goToPage(link.page)">
                    <Chevron
                        :size="5"
                        direction="right"
                        fill="text-dark-gray-900" />
                </button>
            </div>
        </nav>
    </div>
</template>

<script>
import EllipsisHorizontal from '@/Components/Icons/EllipsisHorizontal.vue';
import Chevron from '@/Components/Icons/Chevron.vue';
export default {
    components: {
        EllipsisHorizontal,
        Chevron
    },

    props: {
        links: {
            type: Object,
            default: () => {}
        }
    },

    emits: ['page-changed'],

    data() {
        return {
            nthPage: Math.ceil(this.links.last_page / 2)
        };
    },

    computed: {
        pages() {
            const pages = [];
            let ellipsisAdded = false;
            for (let i = 1; i <= this.links.last_page; i++) {
                if (i === 1 || i === this.links.last_page) {
                    pages.push({
                        page: i,
                        label: i,
                        active: i === this.links.current_page
                    });
                } else if (
                    i > 1 &&
                    i <= this.links.current_page + this.nthPage &&
                    i < this.links.last_page
                ) {
                    pages.push({
                        page: i,
                        label: i,
                        active: i === this.links.current_page
                    });
                } else if (i > this.links.current_page + this.nthPage) {
                    if (!ellipsisAdded) {
                        pages.push({
                            label: '...'
                        });
                        ellipsisAdded = true;
                    }
                }
            }
            return pages;
        }
    },

    methods: {
        goToPage(page) {
            this.$emit('page-changed', page);
        }
    }
};
</script>
