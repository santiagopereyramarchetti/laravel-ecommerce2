<template>
    <div class="flex justify-between border-t border-b border-black py-2">
        <div clas="w-1/3">Item</div>
        <div class="flex justify-between w-1/2">
            <span class="flex-1 text-center">Quantity</span>
            <span class="flex-1 text-right">Price</span>
        </div>
    </div>
    <div>
        <div v-for="(item, index) in items" :key="index" class="flex justify-between border-b border-black py-2">
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
                        <form @submit.prevent="remove(item.rowId)">
                            <button type="submit" class="hover:text-yellow-500">Remove</button>
                        </form>
                        <form @submit.prevent="later(item.rowId)">
                            <button type="submit" class="hover:text-yellow-500">{{actionText}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex justify-between w-1/2">
                <div class="flex-1 text-center">
                    <select v-model="item.qty" @change="update(item.rowId, item.qty)" class="border bg-white rounded outline-none py-0">
                        <option v-for="(qty, index) in item.options.totalQty" :key="index" :value="qty" :selected="qty === item.qty" >{{qty}}</option>
                    </select>
                </div>
                <span class="flex-1 text-right">
                    {{formatCurrency(item.price)}} ea.
                </span>
            </div>
        </div>
    </div>
    
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { formatCurrency } from '@/Helpers/currency.js';

    defineProps({
        items: Object,
        later: Function,
        remove: Function,
        actionText: String,
        update: Function,
    })
</script>

<style lang="scss" scoped>

</style>