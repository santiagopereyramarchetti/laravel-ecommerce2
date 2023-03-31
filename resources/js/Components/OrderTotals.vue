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
                <yellow-button :href="route('checkout.index')" as="href">
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
                <div v-if="code" class="flex justify-between px-4 mt-4">
                    <span>Discount Code ({{code}})</span>
                    <form @submit.prevent="deleteCupon">
                        <span>-{{ formatCurrency(discount) }}</span>
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
                    <yellow-button :href="route('checkout.index')" as="href">
                        Secure checkout
                    </yellow-button>
                </div>
                <div class="text-center mt-4">
                    <Link :href="route('shop.index')" class="underline hover:text-red-700 transition">Continue Shopping</Link>
                </div>
            </div>
        </div>
    </div>
    <div v-if="!code" class="flex flex-col items-center bg-gray-300 shadow-md rounded mt-4 py-6">
        <span class="text-2xl font-semibold">Promo</span>
        <form @submit.prevent="addCoupon" class="w-full">
            <div class="bg-gray-300 px-4">
                <div>
                    <div class="bg-white px-4 py-4 mt-2">
                        <input v-model="form.cupon_code" type="text" class="w-full" placeholder="Enter promo code here">
                        <span v-if="$page.props.errors.message" class="text-md text-red-600 mt-2">
                            {{ $page.props.errors.message }}
                        </span>
                    </div>
                    <div class="text-center mt-4">
                        <gray-button as="button" class="text-sm bg-gray-500">Apply</gray-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
    import YellowButton from './Buttons/YellowButton.vue';
    import GrayButton from '@/Components/Buttons/GrayButton.vue'
    import { Link, useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import { formatCurrency } from '@/Helpers/currency.js'

    defineProps({
        taxRate: Number,
        subtotal: Number,
        newSubtotal: Number,
        tax: Number,
        total: Number,
        code: String,
        discount: Number
    })

    const form = useForm({
        cupon_code: null,
    })

    const addCoupon = () => {
        form.post(route('cupon.store'),{
            preserveScroll: true,
            onSuccess: () => {
                form.reset()
                Toast.fire({
                    icon: 'success',
                    title: 'Cupon has been added!'
                })
            }
        })
    }

    const deleteCupon = () => {
        form.delete(route('cupon.destroy'),{
            preserveScroll: true,
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Cupon has been removed!'
                })
            }
        })
    }
</script>

<style lang="scss" scoped>

</style>