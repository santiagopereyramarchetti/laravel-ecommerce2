<template>
    <app-layout :title="`My Order: ${order.confirmation_number}}`">
        <main-layout>
            <h1 class="text-2xl font-semibold px-6">Order # {{ order.confirmation_number }}</h1>
            <div class="flex space-y-2 px-6 py-2">
                <div>
                    <div class="flex justify-between bg-gray-700 text-sm text-white rounded px-6 py-2 w-full">
                        <form @submit.prevent="print">
                            <yellow-button>Print Invoice</yellow-button>
                        </form>
                        <div class="flex flex-col text-right">
                            <span>Order placed</span>
                            <span>{{ order.created_at }}</span>
                        </div>
                    </div>
                    <div class="border rounded-b divide-y space-y-4 px-6 py-2">
                        <div v-for="(product, index) in order.products" :key="index">
                            <Link :href="route('shop.show', product.slug)" class="flex justify-between space-x-4 divide-x py-6">
                                <div class="flex-1">
                                    <img :src="`/storage/images/${product.main_image}`" :alt="product.name" class="object-cover">
                                </div>
                                <div class="flex-1 pl-4">
                                    <span>{{ product.name }}</span>
                                    <p>{{ product.details }}</p>
                                    <p>{{ product.description }}</p>
                                </div>
                            </Link>
                        </div>
                    </div>
                    <div class="flex justify-end border-t border-b border-black py-2">
                        <div class="flex flex-col">
                            <div class="flex justify-end space-x-2">
                                <span>Subtotal: </span>
                                <span>{{ formatCurrency(order.billing_subtotal) }}</span>
                            </div>
                            <div v-if="order.billing_discount_code" class="flex justify-end space-x-2">
                                <span>Discount: ({{ order.billing_discount_code }})</span>
                                <span>-{{ formatCurrency(order.billing_discount) }}</span>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <span>Tax: </span>
                                <span>{{ formatCurrency(order.billing_tax) }}</span>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <span>Total:</span>
                                <span>{{ formatCurrency(order.billing_total) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </main-layout>
    </app-layout>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import MainLayout from '../../Layouts/MainLayout.vue';
    import YellowButton from '@/Components/Buttons/YellowButton.vue'
    import { Link, useForm } from '@inertiajs/vue3';
    import { formatCurrency } from '@/Helpers/currency.js'


    const props = defineProps({
        order: Object
    })

    const form = useForm({
        order: props.order.confirmation_number
    })

    const print = () => {
        form.post(route('invoice.store', form.order))
    }
</script>

<style lang="scss" scoped>

</style>