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


                <cart-items :items="cartItems" :later="addToLaterCart" :remove="deleteFromCart" actionText="Save for later" :update="updateCart"></cart-items>

                <div class="text-center text-red-600 text-2xl font-semibold mt-4 mb-2 md:text-left">
                    <p v-if="laterCount <= 0">You have saved no items later!</p>
                    <p v-else>{{laterCount}} item(s) saved for later</p>
                </div>

                <cart-items :items="laterItems" :later="addToCart" :remove="deleteFromCartLater" actionText="Move to cart" :update="updateCartLater"></cart-items>

            </div>
            <div class="flex-1">
                <order-totals :taxRate="cartTaxRate" :subtotal="cartSubtotal" :newSubtotal="newSubtotal" :tax="newTax" :total="newTotal" :code="code" :discount="discount"></order-totals>
            </div>
        </div>

    </app-layout>
    
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link, useForm } from '@inertiajs/vue3';
    import { formatCurrency } from '../../Helpers/currency';
    import OrderTotals from '../../Components/OrderTotals.vue';
    import CartItems from '../../Components/CartItems.vue';

    const props = defineProps({
        cartItems: Object,
        cartTaxRate: Number,
        cartSubtotal: Number,
        newTax: Number,
        newSubtotal: Number,
        newTotal: Number,
        laterItems: Object,
        laterCount: Number,
        code: String,
        discount: Number,
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
                Toast.fire({
                    icon: 'success',
                    title: `Item added to later cart`
                })
            }
        })
    }

    const addToCart = (id) => {
        cartForm.post(route('later.moveToCart', id),{
            preserveScroll: true,
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: `Item added to cart`
                })
            }
        })
    }

    const deleteFromCart = (id) => {
        cartForm.delete(route('later.destroy', id),{
            preserveScroll: true,
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: `Item deleted`
                })
            }
        })
    }

    const deleteFromCartLater = (id) => {
        cartForm.delete(route('later.destroyLater', id),{
            preserveScroll: true,
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: `Item deleted`
                })
            }
        })
    }

    const updateCart = (id, quantity) => {
        cartForm.quantity = quantity
        cartForm.patch(route('cart.update', id),{
            preserveScroll: true,
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: `Items in cart updated`
                })
            }
        })
    }

    const updateCartLater = (id, quantity) => {
        cartForm.quantity = quantity
        cartForm.patch(route('later.update', id),{
            preserveScroll: true,
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: `Items in later cart updated`
                })
            }
        })
    }

</script>

<style lang="scss" scoped>

</style>