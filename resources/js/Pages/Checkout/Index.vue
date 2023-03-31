<template>
    <app-layout title="Checkout">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-4 sm:px-6 md:flex md:space-y-0 md:space-x-4 lg:px-8">
            <div class="flex-1">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <form id="payment-form" @submit.prevent="processPayment">
                        <div class="-mx-3 mb-6 w-full md:mb-0">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input v-model="form.name" type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-2 px-4" id="name" required autofocus>
                                <span v-if="errors.name" class="flex justify-center text-md text-red-600 mt-2">{{errors.name[0]}}</span>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6 w-full md:mb-0">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                    Address
                                </label>
                                <input v-model="form.address" type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-2 px-4" id="address" required>
                                <span v-if="errors.address" class="flex justify-center text-md text-red-600 mt-2">{{errors.address[0]}}</span>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6 w-full md:mb-0">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                                    State
                                </label>
                                <select v-model="form.state" id="state" class="block appearance-none w-full bg-gray-100 text-gray-700 border border-gray-400 py-2 px-4 pr-8 rounded" required>
                                    <option v-for="(state, index) in states" :key="index" :selected="state === form.state" :value="state">{{ state }}</option>
                                </select>
                                <span v-if="errors.state" class="flex justify-center text-md text-red-600 mt-2">{{errors.state[0]}}</span>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6 w-full md:mb-0">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                                    City
                                </label>
                                <input v-model="form.city" type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-2 px-4" id="city" required>
                                <span v-if="errors.city" class="flex justify-center text-md text-red-600 mt-2">{{errors.city[0]}}</span>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6 w-full md:mb-0">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip_code">
                                    Zip code
                                </label>
                                <input v-model="form.zip_code" type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-2 px-4" id="zip_code" required>
                                <span v-if="errors.zip_code" class="flex justify-center text-md text-red-600 mt-2">{{errors.zip_code[0]}}</span>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6 w-full md:mb-0">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input v-model="form.email" type="email" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-2 px-4" id="email" required>
                                <span v-if="errors.email" class="flex justify-center text-md text-red-600 mt-2">{{errors.email[0]}}</span>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6 w-full md:mb-0">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_on_card">
                                    Name on Card
                                </label>
                                <input v-model="form.name_on_card" type="name_on_card" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-100 rounded py-2 px-4" id="name_on_card" required>
                                <span v-if="errors.name_on_card" class="flex justify-center text-md text-red-600 mt-2">{{errors.name_on_card[0]}}</span>
                            </div>
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="card-element">
                                    Credit Card
                                </label>
                                <div class="mt-6" id="card-elements"></div>
                                <p id="card-error" role="alert" class="text-red-600 mt-3">{{ cardError }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center mt-6">
                            <yellow-button as="submit" class="text-sm" :class="{'opacity-50 cursor-not-allowed': disabled}" :disabled="disabled">
                                <icon v-if="loading" name="spinner" class="h5 w-5 fill-current"></icon>
                                <span v-else>Pay Now</span>
                            </yellow-button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex-1">
                <order-totals :taxRate="cartTaxRate" :subtotal="cartSubtotal" :newSubtotal="newSubtotal" :tax="newTax" :total="newTotal" :code="code" :discount="discount"></order-totals>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import OrderTotals from '@/Components/OrderTotals.vue'
    import YellowButton from '@/Components/Buttons/YellowButton.vue'
    import Icon from '@/Components/Icons.vue'
    import { ref, reactive, onMounted } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    import states from '@/Data/states.js'
    import { loadStripe } from '@stripe/stripe-js';

    const props = defineProps({
        cartItems: Object,
        cartTaxRate: Number,
        cartSubtotal: Number,
        newTax: Number,
        newSubtotal: Number,
        newTotal: Number,
        code: String,
        discount: Number,
    })

    const form =  reactive({
        name: '',
        email: '',
        address: '',
        city: '',
        state: '',
        zip_code: '',
        name_on_card: '',
    })
    const errors = ref([])
    const loading = ref(false)
    const disabled = ref(true)
    const stripe = ref({})
    const cardElement = ref({})
    const cardError = ref('')
    const elements = ref({})

    const initStripe = async () => {
        stripe.value = await loadStripe(usePage().props.stripe_key)
        elements.value = stripe.value.elements()
        cardElement.value = elements.value.create("card")
        cardElement.value.mount("#card-elements")
        cardElement.value.addEventListener('change', (event) => {
            disabled.value = false
            cardError.value = event.error ? event.error.message : ''
        })
    }

    const processPayment = async () => {
        loading.value = true
        disabled.value = true
        const { paymentMethod, error } = await stripe.value.createPaymentMethod({
            type: 'card',
            card: cardElement.value,
            billing_details: {
                name: form.name,
                email: form.email,
                address: {
                    line1: form.address,
                    city: form.city,
                    state: form.state,
                    postal_code: form.zip_code
                }
            }
        })
        form.payment_method_id = paymentMethod.id
        form.amount = props.newTotal
        axios.post('/checkout', form)
            .then((resp) => {
                errors.value = []
                cardError.value = ''
                console.log(resp)
            })
            .catch((err) => {
                if(err.response.status == 422){
                    errors.value = err.response.data.errors
                }else{
                    cardError.value = err.response.data.message
                }
            })
            loading.value = false
            disabled.value = false
    }

    onMounted( () => {
        initStripe()
    })
</script>

<style lang="scss" scoped>

</style>