<template>
    
    <app-layout title="Cart">

        <div class="max-w-7xl mx-auto px-4 py-4 space-y-4 sm:px-6 md:flex-column md:space-y-0 md:sapce-x-4 lg:px-8">
            <div class="flex-1">
                <div class="flex flex-col itemx-center mb-2 md:flex-row md:justify-between">
                    <p v-if="$page.props.cartCount <= 0" class="text-red-600 text-2xl font-semibold">
                        You cart is Empty!
                    </p>
                    <p v-else class="text-red-600 text-2xl font-semibold">
                        {{ $page.props.cartCount }} item(s) in cart
                    </p>
                    <Link :href="route('shop.index')" class="underline hover:text-red-700 transition">Continue shopping</Link>
                </div>
                <div class="flex justify-between border-t border-b border-black py-2">
                    <div clas="w-1/3">Item</div>
                    <div class="flex justify-between w-1/2">
                        <span class="flex-1 text-center">Quantity</span>
                        <span class="flex-1 text-right">Price</span>
                    </div>
                </div>
                <div>
                    <div v-for="(item, index) in cartItems" :key="index" class="flex justify-between border-b border-black py-2">
                        <div class="flex space-x-4 w-1/2">
                            <Link :href="route('shop.show', item.options.slug)">
                                <img class="object-cover" :src="`/storage/images/${item.options.image}`" alt="">
                            </Link>
                            <div class="flex flex-1 flex-col justify-between">
                                <Link :href="route('shop.show', item.options.slug)" class="flex flex-col">
                                    <span>{{item.name}}</span>
                                    <span>{{item.options.details}}</span>
                                </Link>
                                <div class="flex flex-col mt-4">
                                    <form @submit.prevent="deleteFromCart(item.rowId)">
                                        <button type="submit" class="hover:text-yellow-500">Remove</button>
                                    </form>
                                    <form @submit.prevent="addToLaterCart(item.rowId)">
                                        <button type="submit" class="hover:text-yellow-500">Save for later</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between w-1/2">
                            <div class="flex-1 text-center">
                                <select class="border bg-white rounded outline-none py-0">
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <span class="flex-1 text-right">
                                {{formatCurrency(item.price)}} ea.
                            </span>
                        </div>
                    </div>
                </div>

                <div class="text-center text-red-600 text-2xl font-semibold mt-4 mb-2 md:text-left">
                    <p v-if="laterCount <= 0">You have saved no items later!</p>
                    <p v-else>{{laterCount}} item(s) saved for later</p>
                </div>

                <div class="flex justify-between border-t border-b border-black py-2">
                    <div clas="w-1/3">Item</div>
                    <div class="flex justify-between w-1/2">
                        <span class="flex-1 text-center">Quantity</span>
                        <span class="flex-1 text-right">Price</span>
                    </div>
                </div>
                <div>
                    <div v-for="(item, index) in laterItems" :key="index" class="flex justify-between border-b border-black py-2">
                        <div class="flex space-x-4 w-1/2">
                            <Link :href="route('shop.show', item.options.slug)">
                                <img class="object-cover" :src="`/storage/images/${item.options.image}`" alt="">
                            </Link>
                            <div class="flex flex-1 flex-col justify-between">
                                <Link :href="route('shop.show', item.options.slug)" class="flex flex-col">
                                    <span>{{item.name}}</span>
                                    <span>{{item.options.details}}</span>
                                </Link>
                                <div class="flex flex-col mt-4">
                                    <form @submit.prevent="deleteFromCartLater(item.rowId)">
                                        <button type="submit" class="hover:text-yellow-500">Remove</button>
                                    </form>
                                    <form @submit.prevent="addToCart(item.rowId)">
                                        <button type="submit" class="hover:text-yellow-500">Move to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between w-1/2">
                            <div class="flex-1 text-center">
                                <select class="border bg-white rounded outline-none py-0">
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <span class="flex-1 text-right">
                                {{formatCurrency(item.price)}} ea.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <order-totals :taxRate="cartTaxRate" :subtotal="cartSubtotal" :tax="cartTax" :total="newTotal"></order-totals>
            </div>
        </div>

    </app-layout>
    
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link, useForm } from '@inertiajs/vue3';
    import OrderTotals from '../../Components/OrderTotals.vue';
    import { formatCurrency } from '../../Helpers/currency';

    const props = defineProps({
        cartItems: Object,
        cartTaxRate: Number,
        cartSubtotal: Number,
        cartTax: Number,
        newTotal: Number,
        laterItems: Object,
        laterCount: Number,
    })

    const quantity = 1
    const index = 1

    const cartForm = useForm({
        cartItems: props.cartItems,
        quantity: 0 
    })

    const addToLaterCart = (id) => {
        cartForm.post(route('later.store', id),{
            preserveScroll: true,
            onSuccess: () => {

            }
        })
    }

    const addToCart = (id) => {
        cartForm.post(route('later.moveToCart', id),{
            preserveScroll: true,
            onSuccess: () => {

            }
        })
    }

    const deleteFromCart = (id) => {
        cartForm.delete(route('later.destroy', id),{
            preserveScroll: true,
            onSuccess: () => {

            }
        })
    }

    const deleteFromCartLater = (id) => {
        cartForm.delete(route('later.destroyLater', id),{
            preserveScroll: true,
            onSuccess: () => {

            }
        })
    }

</script>

<style lang="scss" scoped>

</style>