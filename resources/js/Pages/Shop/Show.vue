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
            <div id="img-container" class="border-2 mx-auto p-2 cursor-zoom">
                <img id="current-img" :src="`/storage/images/${currentImg}`" :alt="product.name" class="w-full h-full object-cover">
            </div>
            <!-- <div class="border-2 p-2">
                <img class="w-full object-cover" :src="`/storage/images/${product.main_image}`" :alt="product.name">
            </div> -->
            <div class="mt-6">
                <Carousel :settings="settings" :breakpoints="breakpoints">
                    <Slide @click="changeCurrentImage(image, index)" v-for="(image, index) in slides" :key="index" :class="{ slected: index === isActive, 'border-red-600': index === isActive}" class="cursor-pointer border-2 border-black hover:border-blue-600">
                        <div class="carousel__item">
                            <img :src="`/storage/images/${image}`" alt="" :class="{'opacity-50': index !== isActive}" class="w-full h-full object-cover">
                        </div>
                    </Slide>

                    <template #addons>
                        <Navigation />
                    </template>
                </Carousel>
            </div>
        </div>
        <div class="flex-1 space-y-6 sm:mt-0 sm:border-l sm:pl-4">
            <form @submit.prevent="submit">
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
                    <button @click.prevent="openDescription=!openDescription" type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Product Description</span>
                        <icons v-if="openDescription" name="angle-down" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                        <icons v-else name="angle-left" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                    </button>
                    <div v-if="openDescription" class="bg-gray-50 px-4 py-4 sm:px-6 lg_px-8">
                        <p>
                            {{ product.description }}
                        </p>
                    </div>
                </div>
                <div>
                    <button  @click.prevent="openFeatures=!openFeatures" type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Product Features</span>
                        <icons v-if="openFeatures" name="angle-down" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                        <icons v-else name="angle-left" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                    </button>
                    <div v-if="openFeatures" class="bg-gray-50 px-4 py-4 sm:px-6 lg_px-8">
                        <p>
                            {{ product.description }}
                        </p>
                    </div>
                </div>
                <div>
                    <button  @click.prevent="openPolicy=!openPolicy" type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Product Policy</span>
                        <icons v-if="openPolicy" name="angle-down" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                        <icons v-else name="angle-left" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                    </button>
                    <div v-if="openPolicy" class="bg-gray-50 px-4 py-4 sm:px-6 lg_px-8">
                        <p>
                            {{ product.description }}
                        </p>
                    </div>
                </div>
                <div>
                    <button  @click.prevent="openReviews=!openReviews" type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                        <span>Product Reviews</span>
                        <icons v-if="openPolicy" name="angle-down" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                        <icons v-else name="angle-left" class="w-5 h-5 text-yellow-500 fill-current"></icons>
                    </button>
                    <div v-if="openReviews" class="bg-gray-50 px-4 py-4 sm:px-6 lg_px-8">
                        <p>
                            {{ product.description }}
                        </p>
                    </div>
                </div>
                <div class="text-center">
                    <p>Suggested based on your search</p>
                </div>
                <div class="flex space-x-4">
                    <Link v-for="(item, index) in similarProducts" :key="index" :href="route('shop.show', item.slug)" class="flex border border-black w-1/4 h-24">
                        <img class="w-full object-cover" :src="`/storage/images/${item.main_image}`" :alt="item.name">
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
    import { ref, onMounted } from 'vue';
    import SecondaryHeader from '../../Components/SecondaryHeader.vue';
    import Icons from '@/Components/Icons.vue'
    import GrayButton from '@/Components/Buttons/GrayButton.vue'
    import { Carousel, Slide, Navigation } from 'vue3-carousel'
    import { formatCurrency } from '@/Helpers/currency.js'

    const props = defineProps({
        product: Object,
        similarProducts: Object,
    });

    const quantity = ref(1)

    const openDescription =  ref(false)
    const openFeatures =  ref(false)
    const openPolicy =  ref(false)
    const openReviews =  ref(false)

    const form = useForm({
        id: props.product.id,
        name: props.product.name,
        price: props.product.price,
        product_code: props.product.product_code,
        details: props.product.details,
        main_image: props.product.main_image,
        slug: props.product.slug,
        quantity: 1,
        totalQty: props.product.quantity,
    })

    const submit = () => {
        form.post(route('cart.store'),{
            preserveScroll: true,
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: `${form.name} has successfully added`
                })
            },
        })
    }

    const slides = [props.product.main_image]

    const settings = {
      itemsToShow: 1,
      snapAlign: 'center',
    }

    const breakpoints = {
      700: {
        itemsToShow: 3.5,
        snapAlign: 'center',
      },
      1024: {
        itemsToShow: 5,
        snapAlign: 'start',
      },
    }

    const currentImg = ref(props.product.main_image)
    const isActive = ref(0)
    const selected = ref(false)

    const changeCurrentImage = (image, index) =>{
        if(image){
            currentImg.value = image
            isActive.value = index
            selected.value = false
        }else{
            currentImg.value = props.product.main_image
            if(isActive.value == index){
                selected.value = false
            }else{
                selected.value = true
            }
        }
    }
    
    onMounted(() => {
        zoomImage()
    })

    const zoomImage = () => {
        let container = document.querySelector('#img-container')
        let img = document.querySelector('#current-img')
        container.addEventListener("mousemove", (e) => {
            let x = e.clientX - e.target.offsetLeft
            let y = e.clientY - e.target.offsetTop
            img.style.transformOrigin = `${x}px ${y}px`
            img.style.transform = "scale(3)"
        })
        container.addEventListener("mouseleave", () => {
            img.style.transformOrigin = "center"
            img.style.transform = "scale(1)"
        })
    }

</script>

<style lang="scss" scoped>

</style>