<template>
    <app-layout :title="product.slug">
    <secondary-header>
        <template #breadcrumbs>
            <Link :href="route('shop.index')" class="text-gray-700 transition hover:text-yellow-500">Shop ></Link>
            <span>{{ product.name }}</span>
        </template>
        <template #search>
            search
        </template>
    </secondary-header>

    <div class="max-w-7xl mx-auto px-4 py-4 sm:flex sm:space-x-4 sm:px-6 lg:px-8">
        <div class="flex-1 sm:border-r">
            <div class="border-2 p-2">
                <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
            </div>
            <div class="flex space-x-4 mt-4">
                <button type="button">
                    <icons name="angle-left" class="w-4 h-4 fill-current"></icons>
                </button>
                <div class="w-1/4">
                    <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                </div>
                <div class="w-1/4">
                    <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                </div>
                <div class="w-1/4">
                    <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                </div>
                <div class="w-1/4">
                    <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                </div>
                <button type="button">
                    <icons name="angle-right" class="w-4 h-4 fill-current"></icons>
                </button>
            </div>
        </div>
        <div class="flex-1 space-y-6 sm:mt-0 sm:border-l sm:pl-4">
            <form>
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold capitalize italic">{{ product.name }}</h2>
                    <div class="text-xl capitalize italic">
                        <span>
                            Price:
                        </span>
                        <span>
                            {{ formatCurrency(product.price) }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-4 mt-4">
                    <p class="tet-xl capitalize">
                        {{ product.details }}
                    </p>
                </div>
                <div class="flex space-x-4 mt-4">
                    <span>
                        Sku:
                    </span>
                    <p class="text-xl capitalize">
                        {{ product.product_code }}
                    </p>
                </div>
                <div class="mt-4">
                    <template v-if="product.quantity <= 0">
                        <div class="mt-4">
                            <span class="text-red-600 font-semibold italic uppercase">Sold Out</span>
                        </div>
                    </template>
                    <template v-else-if="product.quantity <= 5">
                        <div class="mt-4">
                            <span class="text-yellow-600 font-semibold italic uppercase">Only a few left</span>
                        </div>
                        <label for="quantity" class="flex-1 text-xl capitalize">
                            Qty:
                        </label>
                        <select v-model="form.quantity" class="flex-1 w-full border bg-white rounded px-3 py-1 outline-none">
                            <option v-for="(qty, index) in product.quantity" :key="index" :value="qty" :selected="qty === quantity">{{qty}}</option>
                        </select>
                    </template>
                    <template v-else>
                        <div class ="flex items-center">
                            <label for="quantity" class="flex-1 text-xl capitalize">
                                Qty:
                            </label>
                            <select v-model="form.quantity" class="flex-1 w-full border bg-white rounded px-3 py-1 outline-none">
                                <option v-for="(qty, index) in product.quantity" :key="index" :value="qty" :selected="qty === quantity">{{qty}}</option>
                            </select>
                        </div>
                    </template>
                    
                </div>
                <div class="text-center mt-4">
                    <gray-button v-if="product.quantity > 0" as="submit" class="text-sm bg-slate-500">
                        <span>Add to Cart</span>
                    </gray-button>
                </div>
            </form>
            <div class="flex flex-col divide-y">
                <div>
                    <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Product Description</span>
                    </button>
                </div>
                <div>
                    <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Product Features</span>
                    </button>
                </div>
                <div>
                    <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Product Policy</span>
                    </button>
                </div>
                <div>
                    <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Reviews</span>
                    </button>
                </div>
                <div class="text-center">
                    <p>Suggested based on your search</p>
                </div>
                <div class="flex space-x-4">
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                    </Link>
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                    </Link>
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                    </Link>
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img class="w-full object-cover" :src="`/storage/images/${product.image}`" :alt="product.name">
                    </Link>
                </div>
            </div>
        </div>
    </div>

    </app-layout>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue'; 
    import { Link, useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import SecondaryHeader from '../../Components/SecondaryHeader.vue';
    import Icons from '@/Components/Icons.vue'
    import GrayButton from '@/Components/Buttons/GrayButton.vue'
    import { formatCurrency } from '@/Helpers/currency.js'

    const props = defineProps({
        product: Object,
    });

    const quantity = ref(1)

    const form = useForm({
        id: props.product.id,
        name: props.product.name,
        price: props.product.price,
        product_code: props.product.product_code,
        details: props.product.details,
        image: props.product.image,
        slug: props.product.slug,
        quantity: 1,
    })

    const submitForm = () => {
        form.post()
    }

</script>

<style lang="scss" scoped>

</style>