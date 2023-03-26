<template>
    
    <app-layout title="Cart">

        <div class="max-w-7xl mx-auto px-4 py-4 space-y-4 sm:px-6 md:flex-column md:space-y-0 md:sapce-x-4 lg:px-8">
            <div class="flex-1">
                <div class="flex flex-col itemx-center mb-2 md:flex-row md:justify-between">
                    <p class="text-red-600 text-2xl font-semibold">
                        You cart is Empty!
                    </p>
                    <p class="text-red-600 text-2xl font-semibold">
                        5 item(s) in cart
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
                    <div class="flex justify-between border-b border-black py-2">
                        <div class="flex space-x-4 w-1/2">
                            <Link href="#">
                                <img class="object-cover" src="storage/images/site_images/hand_craft.jpg" alt="">
                            </Link>
                            <div class="flex flex-1 flex-col justify-between">
                                <Link href="#" class="flex flex-col">
                                    <span>Lorem, ipsum dolor.</span>
                                    <span>Lorem ipsum dolor sit amet.</span>
                                </Link>
                                <div class="flex flex-col mt-4">
                                    <form>
                                        <button type="submit" class="hover:text-yellow-500">Remove</button>
                                    </form>
                                    <form>
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
                                $5.99 ea.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="text-center text-red-600 text-2xl font-semibold mt-4 mb-2 md:text-left">
                    <p>You have saved no items later!</p>
                    <p>5 item(s) saved for later</p>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between border-t border-b border-black py-2">
                    <div clas="w-1/3">Item</div>
                    <div class="flex justify-between w-1/2">
                        <span class="flex-1 text-center">Quantity</span>
                        <span class="flex-1 text-right">Price</span>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between border-b border-black py-2">
                        <div class="flex space-x-4 w-1/2">
                            <Link href="#">
                                <img class="object-cover" src="storage/images/site_images/hand_craft.jpg" alt="">
                            </Link>
                            <div class="flex flex-1 flex-col justify-between">
                                <Link href="#" class="flex flex-col">
                                    <span>Lorem, ipsum dolor.</span>
                                    <span>Lorem ipsum dolor sit amet.</span>
                                </Link>
                                <div class="flex flex-col mt-4">
                                    <form>
                                        <button type="submit" class="hover:text-yellow-500">Remove</button>
                                    </form>
                                    <form>
                                        <button type="submit" class="hover:text-yellow-500">Move to cart</button>
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
                                $5.99 ea.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <order-totals></order-totals>
            </div>
        </div>

    </app-layout>
    
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import OrderTotals from '../../Components/OrderTotals.vue';

</script>

<style lang="scss" scoped>

</style>