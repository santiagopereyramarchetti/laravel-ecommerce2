<template>
    <app-layout title="Search Algolia">
        <secondary-header>
            <template #breadcrumbs>
                <span>Search Coder's Shop</span>
            </template>
        </secondary-header>
        <ais-instant-search
            :search-client="searchClient"
            :index-name="indexName"
            class="flex flex-col space-y-4 max-w-7xl mx-auto my-4 py-2 px-4 sm:flex-row sm:space-y-0 sm:space-x-4 md:px-6 lg:px-8"
        >
            <div>
                <ais-search-box :placeholder="placeholder"></ais-search-box>
                <ais-stats class="text-center mt-4 font-semibold"></ais-stats>
                <ais-refinement-list :attribute="attribute" :sort-by="['isRefined', 'price:asc']" class="flex justify-center mt-4 sm:justify-start"/>
                <ais-powered-by class="flex justify-center mt-4 sm:justify-end"></ais-powered-by>
                
            </div>
            <ais-configure :hits-per-page.camel="5"></ais-configure>
            <div>
                <ais-hits>
                    <template v-slot:item="{item}">
                        <Link :href="route('shop.show', item.slug)" class="flex space-x-8">
                            <div class="flex w-24 h-24">
                                <img :src="`/storage/images/`+item.image" :alt="item.name" class="object-cover">
                            </div>
                            <div class="flex flex-col">
                                <h3 class="text-xl font-semibold">
                                    <ais-highlight :hit="item" attribute="name"></ais-highlight>
                                </h3>
                                <span>{{ item.description }}</span>
                                <span>{{ formatCurrency(item.price) }}</span>
                            </div> 
                        </Link>
                    </template>
                </ais-hits>
                <ais-pagination class="flex justify-center mt-4"></ais-pagination>
            </div>
        </ais-instant-search>
    </app-layout>
</template>

<script setup>
    import AppLayout from '../../../Layouts/AppLayout.vue';
    import SecondaryHeader from '../../../Components/SecondaryHeader.vue';
    import algoliasearch from 'algoliasearch/lite'
    import { Link, usePage } from '@inertiajs/vue3';
    import { formatCurrency } from '../../../Helpers/currency';

    defineProps({
        products: Object,
    })

    const indexName = 'products'
    const placeholder = 'Search...'
    const attribute = 'categories'
    const searchClient = algoliasearch(
        usePage().props.algolia_key,
        usePage().props.algolia_secret
    )

</script>

<style lang="scss" scoped>

</style>