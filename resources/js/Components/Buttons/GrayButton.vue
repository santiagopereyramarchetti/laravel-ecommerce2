<template>
    <Link :href="href" :class="classes" v-if="as == 'href'">
        <slot></slot>
    </Link>
    <button :class="classes" v-else>
        <slot></slot>
    </button>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { computed } from 'vue';

    defineProps({
        active: Boolean,
        href: String,
        as: String,
    })

    const classes = computed(() => {
        return 'text-md justify-center inline-flex items-center border border-transparent rounded-md font-semibold text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition'
    })

</script>

<style lang="scss" scoped>

</style>