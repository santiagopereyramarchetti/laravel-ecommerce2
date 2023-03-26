<template>
    <div class="shadow-md rounded sm:my-2">
        <div class="flex flex-col items-center space-y-4 py-6 bg-gray-700">
            <div class="flex space-x-4">
                <span class="text-white">
                    Order total(before tax & disscount(s))
                </span>
                <span class="text-yellow-500">
                    {{formatCurrency(subtotal)}}
                </span>
            </div>
            <div>
                <yellow-button href="#">
                    Secure checkout
                </yellow-button>
            </div>
        </div>
        <div class="bg-gray-300 px-4 py-6">
            <div>
                <span class="px-4">Order summary</span>
                <div class="flex justify-between bg-white px-4 py-2 mt-4">
                    <span>Item(s) subtotal({{ $page.props.cartCount }})</span>
                    <span>{{formatCurrency(subtotal)}}</span>  
                </div>
                <div class="flex justify-between px-4 mt-4">
                    <span>Shipping</span>
                    <span>Free</span>  
                </div>
                <div class="flex justify-between px-4 mt-4">
                    <span>Discount Code (ABC123)</span>
                    <form>
                        <span>-$2.00</span>
                        <button class="text-red-600 ml-2">X</button>
                    </form>
                </div>
                <div class="flex justify-between px-4 mt-4">
                    <span>Estimated Tax</span>
                    <span>{{formatCurrency(tax)}}</span>  
                </div>
                <div class="px-4 py-2 mt-4 bg-white">
                    <div class="flex justify-between">
                        <span>Order Total</span>
                        <span>{{formatCurrency(total)}}</span>  
                    </div>
                    <div class="flex flex-col">
                        <span>({{taxRate}}% tax rate)</span>
                        <span>Lorem, ipsum dolor.</span>  
                    </div>
                </div>
                <div class="text-center mt-4">
                    <yellow-button href="#">
                        Secure checkout
                    </yellow-button>
                </div>
                <div class="text-center mt-4">
                    <Link :href="route('shop.index')" class="underline hover:text-red-700 transition">Continue Shopping</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import YellowButton from './Buttons/YellowButton.vue';
    import { formatCurrency } from '@/Helpers/currency.js'

    defineProps({
        taxRate: Number,
        subtotal: Number,
        tax: Number,
        total: Number
    })
</script>

<style lang="scss" scoped>

</style>