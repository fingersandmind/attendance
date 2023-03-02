<script setup>
import { computed } from 'vue';
import { fixedClasses, variants, sizes } from '@/Composables/useButton';

const props = defineProps({
    href: {
        type: String,
        default: null
    },
    type: {
        type: String,
        default: 'submit'
    },
    variant: {
        type: String,
        default: 'primary'
    },
    size: {
        type: String,
        default: 'md'
    },
    iconEnd: {
        type: Object,
        default: null
    },
    iconStart: {
        type: Object,
        default: null
    }
});

const btnType = computed(() => {
    if (props.href) {
        return 'a';
    } else {
        return 'button';
    }
});
</script>

<template>
    <component
        :is="btnType"
        :href="href"
        :type="type"
        :class="[fixedClasses, variants[variant] + ' ' + sizes[size]]"
        v-bind="$attrs">
        <component :is="iconStart" v-if="iconStart" class="mr-2" />
        <slot />
        <component :is="iconEnd" v-if="iconEnd" class="ml-2" />
    </component>
</template>
