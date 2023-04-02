<template>
    <div id="confirmation" class="flex flex-col items-center space-y-4 w-full">
        <h2 class="text-lg font-semibold italic">Thanks for placing your order.</h2>
        <div class="flex justify-between items-center w-full">
            <div>
                <span class="font-semibold">Your confirmation # is: </span><span>{{ order.confirmation_number }}</span>
            </div>
            <div>
                <yellow-button as="button" id="print" class="text-sm" @click="print">Print</yellow-button>
            </div>
        </div>
        <div class="w-full">
            <div class="flex justify-between border-t border-b vorder-black py-2">
                <div class="w-1/3">Item</div>
                <div class="flex justify-between w-2/3">
                    <span class="flex-1 text-center">Quantity</span>
                    <span class="flex-1 text-right">Price</span>
                </div> 
            </div>
            <div v-for="(item, index) in order.items" :key="index">
                <div class="flex justify-between border-b border-black py-2">
                    <div class="flex justify-between border-b border-black py-2">
                        <div class="flex space-x-4 w-1/2">
                            <Link :href="route('shop.show', item.slug)" class="flex flex-1">
                                <img :src="`/storage/images/${item.image}`" :alt="item.name" class="object-cover">
                            </Link>
                            <div class="flex flex-1 flex-col justify-between">
                                <Link href="#" class="flex flex-col">
                                    <span>{{ item.name }}</span>
                                </Link>
                            </div>
                        </div>
                        <div class="flex justify-between w-1/2">
                            <div class="flex-1 text-center">
                                {{ item.pivot.quantity }}
                            </div>
                            <span class="flex-1 text-right">{{ formatCurrency(item.price) }} ea.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end borer-t border-b border-black py-2">
                <div class="flex flex-col">
                    <div class="flex justify-end space-x-2">
                        <span>Subtotal: </span>
                        <span>{{ formatCurrency(order.billing_subtotal) }}</span>
                    </div>
                    <div class="flex justify-end space-x-2" v-if="order.billing_discount_code">
                        <span>Disscount: ({{ formatCurrency(order.billing_discount_code) }})</span>
                        <span>- {{ formatCurrency(order.billing_discount) }}</span>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <span>Tax: </span>
                        <span>{{ formatCurrency(order.billing_tax) }}</span>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <span>Total: </span>
                        <span>{{ formatCurrency(order.billing_total) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { formatCurrency } from '@/Helpers/currency.js'
    import { Link } from '@inertiajs/vue3';
    import YellowButton from '@/Components/Buttons/YellowButton.vue'
    
    defineProps({
        order: Object,
    })

    const print = () => {
        window.print()
    }

</script>

<style lang="scss" scoped>
    @media print{
        button#hamburguer, button#print{
            display: none;
        }
        #confirmation{
            padding: 20px 30px;
        }
    }

    @page {
        size: auto;
        margin: 0mm;
    }
</style>