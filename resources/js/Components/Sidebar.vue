<script setup>
import { ref } from "vue";
import Icon from "@/Components/Icon.vue";
import SideNavLink from "@/Components/SideNavLink.vue";

const props = defineProps({
    isSidebarOpen: Boolean,
});

const emit = defineEmits(['close']);

const closeDrawer = () => {
    emit('close');
};

const isDropdownOpen = ref(false);

</script>
<template>
    <aside
        class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-gray-800 shadow-lg lg:z-auto lg:static lg:shadow-none"
        :class="{
            '-translate-x-full lg:translate-x-0 lg:w-20':
                !isSidebarOpen,
        }">
        <!-- sidebar header -->
        <div class="overflow-y-auto overflow-x-hidden">
            <div class="flex items-center justify-between flex-shrink-0 p-2"
                :class="{ 'lg:justify-center': !isSidebarOpen }">
                <span
                    class="flex items-center flex-nowrap space-x-2 text-xl leading-8 tracking-wider uppercase whitespace-nowrap">
                    <img src="/images/logo.png" class="w-12 h-auto" alt="logo" />
                    <span class="antialiased tracking-wider font-black leading-none text-white"
                        :class="{ 'lg:hidden': !isSidebarOpen }">PRIMS</span>
                </span>
                <button @click="closeDrawer" class="p-2 rounded-md lg:hidden">
                    <Icon name="close" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                </button>
            </div>
            <!-- Sidebar links -->
            <nav class="flex-1 overflow-hidden">
                <ul class="flex flex-col gap-y-1 p-2 overflow-hidden">
                    <li>
                        <SideNavLink :href="route('admin.index')" :active="route().current('admin.index')"
                            :isSidebarOpen="isSidebarOpen">
                            <Icon name="home" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.residents.index')"
                            :active="route().current('admin.residents.index')" :isSidebarOpen="isSidebarOpen">
                            <Icon name="group" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Residents</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.accommodations.index')"
                            :active="route().current('admin.accommodations.index')" :isSidebarOpen="isSidebarOpen">
                            <Icon name="home_modern" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Accommodations</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.business-establishments.index')"
                            :active="route().current('admin.business-establishments.index')"
                            :isSidebarOpen="isSidebarOpen">
                            <Icon name="home_modern" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Establishments</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.households.index')"
                            :active="route().current('admin.households.index')" :isSidebarOpen="isSidebarOpen">
                            <Icon name="home" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Households</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.dependents.index')"
                            :active="route().current('admin.dependents.index')" :isSidebarOpen="isSidebarOpen">
                            <Icon name="users" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Dependents</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.accommodation-tenants.index')"
                            :active="route().current('admin.accommodation-tenants.index')"
                            :isSidebarOpen="isSidebarOpen">
                            <Icon name="users" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Tenants</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.business-managers.index')"
                            :active="route().current('admin.business-managers.index')" :isSidebarOpen="isSidebarOpen">
                            <Icon name="users" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Managers</span>
                        </SideNavLink>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>