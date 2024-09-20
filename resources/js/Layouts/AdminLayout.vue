<script setup>
import { ref } from "vue";
import { Head, router, Link } from "@inertiajs/vue3";
import Sidebar from "@/Components/Sidebar.vue";
import Icon from "@/Components/Icon.vue";

defineProps({
    title: String,
});

const isSidebarOpen = ref(true);
const isNotificationMenuOpen = ref(false);
const isUserMenuOpen = ref(false);

const menus = [isUserMenuOpen, isNotificationMenuOpen];

const onClickAway = () => {
    menus.forEach((menu) => {
        if (menu.value) {
            menu.value = false;
        }
    });
};

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>

    <Head :title="title" />

    <div class="antialiased text-gray-900 bg-white">
        <div class="flex h-screen overflow-y-hidden bg-white">
            <!-- Sidebar -->
            <Sidebar :isSidebarOpen="isSidebarOpen" @close="isSidebarOpen = false" />

            <div class="flex flex-col flex-1 h-full overflow-hidden">
                <header class="flex-shrink-0 border-b">
                    <div class="flex items-center justify-between p-2">
                        <!-- Navbar left -->
                        <div class="flex items-center space-x-3">
                            <span class="text-xl font-semibold tracking-wider uppercase lg:hidden"><img
                                    src="/images/logo.png" class="w-12 h-auto" alt="Barangay Logo" /></span>
                            <button @click="isSidebarOpen = !isSidebarOpen"
                                class="p-2 rounded-md focus:outline-none focus:ring focus:ring-teal-800">
                                <div :class="{
        'transform transition-transform -rotate-180':
            isSidebarOpen,
    }">
                                    <Icon name="chevron_double_right" stroke="#115e59" :classes="'size-5'" fill="none"
                                        stroke_width="2" />
                                </div>
                            </button>
                        </div>

                        <!-- Navbar right -->
                        <div class="relative flex items-center space-x-3">
                            <!-- User Menu -->
                            <div class="relative">
                                <button @click="isUserMenuOpen = !isUserMenuOpen"
                                    class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring">
                                    <img class="object-cover w-8 h-8 rounded-full" :src="$page.props.auth.user
        .profile_photo_url
        " :alt="$page.props.auth.user
        .name
        " />
                                </button>
                                <!-- green dot -->
                                <div class="absolute right-0 p-1 bg-green-400 rounded-full bottom-3 animate-ping"></div>
                                <div
                                    class="absolute right-0 p-1 bg-green-400 border border-white rounded-full bottom-3">
                                </div>

                                <div v-if="isUserMenuOpen" v-click-away="onClickAway"
                                    class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
                                    <div class="flex flex-col p-4 space-y-1 font-medium border-b">
                                        <span class="text-gray-800">{{ $page.props.auth.user.name }}</span>
                                        <span class="text-sm text-gray-400">{{ $page.props.auth.user.email }}</span>
                                    </div>
                                    <ul class="flex flex-col p-2 space-y-1">
                                        <li class="rounded-md hover:bg-teal-100">
                                            <Link :href="route('profile.show')"
                                                class="block px-2 py-1 transition">Profile
                                            </Link>
                                        </li>
                                    </ul>
                                    <div class="flex items-center justify-center p-4 border-t">
                                        <form @submit.prevent="logout">
                                            <button class="underline  text-teal-800 hover:text-teal-600" type="submit">
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main content -->
                <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
