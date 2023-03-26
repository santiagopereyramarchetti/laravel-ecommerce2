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
        return 'text-sm inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded font-semibold text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition'
    })

</script>

<style lang="scss" scoped>

</style>