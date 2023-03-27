<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('welcome')" class="block w-auto hover:text-yellow-500 transition">
                            Coder's Shop
                        </Link>
                    </div>

                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">

                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <div class="flex-items-center space-x-3 relative">
                            <Link v-if="$page.props.user" :href="route('dashboard')" class="hover:text-yellow-500 transition">Register</Link>
                            <template v-else>
                                <Link  :href="route('register')" class="hover:text-yellow-500 transition">Register</Link>
                                <Link  :href="route('login')" class="hover:text-yellow-500 transition">Login</Link>
                            </template>
                            <Link  :href="route('shop.index')" class="hover:text-yellow-500 transition">Shop</Link>
                            <form action="POST" @submit.prevent="logout" v-if="$page.props.user">
                                <button type="subbmit" class="hover:text-yellow-500">Log out</button>
                            </form>
                            <Link  :href="route('cart.index')" class="hover:text-red-700 transition ">
                                <span v-if="$page.props.cartCount > 0" class="bg-red-600 text-white text-xs rounded-md p-1 absolute -top-1 -right-1">{{ $page.props.cartCount }}</span>
                                <Icons name="cart" class="w-8 h-8 inline-flex"></Icons>
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
            <template v-if="$page.props.user">
                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</ResponsiveNavLink>
            </template>
            <template v-else>
                <ResponsiveNavLink :href="route('register')">Register</ResponsiveNavLink>
                <ResponsiveNavLink :href="route('login')">Login</ResponsiveNavLink>
            </template>
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('shop.index')">Shop</ResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('cart.index')" class="p-0 flex items-center border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-red-700 hover:border-red-700 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition">
                    <div class="relative">
                        <Icons name="cart" class="w-8 h-8 inline-flex"></Icons>
                        <span v-if="$page.props.cartCount > 0" class="ml-4 bg-red-600 text-white text-xs rounded-md p-1">
                            {{ $page.props.cartCount }} item(s) in cart
                        </span>
                    </div>
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.user">

                <div class="mt-3 space-y-1">


                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <ResponsiveNavLink as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </form>

                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
    import { Link, router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
    import Icons from './Icons.vue';

    const showingNavigationDropdown = ref(false);

    const logout = () => {
        router.post(route('logout'));
    };
</script>

<style lang="scss" scoped>

</style>