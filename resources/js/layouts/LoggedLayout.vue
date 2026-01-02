<script setup lang="ts">
import { ref } from 'vue';
import Dashboard from '@/components/svgs/Dashboard.vue';
import Paw from '@/components/svgs/Paw.vue';
import Logo from '@/components/svgs/Logo.vue';
import Hearth from '@/components/svgs/Hearth.vue';
import User from '@/components/svgs/User.vue';
import Statistiques from '@/components/svgs/Statistiques.vue';
import Notifications from '@/components/svgs/Notifications.vue';
import Database from '@/components/svgs/Database.vue';
import Logout from '@/components/svgs/Logout.vue';
import NavLink from '@/components/nav/NavLink.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { index as DashboardIndex } from '@/actions/App/Http/Controllers/DashboardController';
import { index as AnimalsIndex } from '@/actions/App/Http/Controllers/AnimalsController';
import { index as AdoptionsIndex } from '@/actions/App/Http/Controllers/AdoptionsController';
import { index as UsersIndex } from '@/actions/App/Http/Controllers/UsersController';
import { index as NotificationsIndex } from '@/actions/App/Http/Controllers/NotificationsController';
import { index as StatistiquesIndex } from '@/actions/App/Http/Controllers/StatistiquesController';
import { index as DatabaseIndex } from '@/actions/App/Http/Controllers/DatabaseController';
import { edit } from '@/actions/App/Http/Controllers/Settings/ProfileController';
import Toaster from '@/components/Toaster.vue';

defineProps<{
    title?: string;
    description?: string;
}>();

const page = usePage();
const userName = page.props.auth.user.name;
const isMenuOpen = ref(false);

const initials = userName
    .split(' ')
    .filter(n => n.length > 0)
    .map(n => n[0])
    .join('')
    .toUpperCase();

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
    isMenuOpen.value = false;
};
</script>

<template>
    <div class="md:grid md:grid-cols-12 md:gap-4">
        <Head :title="title" />
        <header class="md:hidden fixed top-0 left-0 right-0 bg-white border-b-2 border-gray-100 px-4 py-3 flex justify-between items-center z-50">
            <Logo classes="w-40" />
            <button @click="toggleMenu" class="p-2 rounded-lg" aria-label="Menu">
                <svg v-if="!isMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </header>
        <div v-if="isMenuOpen"
             @click="closeMenu"
             class="md:hidden fixed inset-0 bg-black/50 z-40 transition-opacity"
        ></div>
        <nav
            :class="[
                'md:hidden fixed top-0 left-0 h-screen w-64 bg-white border-r-2 border-gray-100 px-3.5 flex flex-col justify-between items-center py-10 z-50 transition-transform duration-300',
                isMenuOpen ? 'translate-x-0' : '-translate-x-full'
            ]"
            aria-labelledby="mobile-nav"
        >
            <h2 id="mobile-nav" class="sr-only">Navigation principale</h2>
            <Logo classes="w-full" />

            <div class="flex flex-col gap-5 w-full">
                <NavLink
                    @click="closeMenu"
                    :active="{'nav-link-active': $page.component==='Dashboard'}"
                    :href="DashboardIndex()"
                    title="Dashboard"
                >
                    <Dashboard :active="$page.component==='Dashboard'" />
                </NavLink>
                <NavLink
                    @click="closeMenu"
                    :active="{'nav-link-active': $page.component==='Animals'}"
                    :href="AnimalsIndex()"
                    title="Animaux"
                >
                    <Paw classes="w-6" :active="$page.component==='Animals'" />
                </NavLink>
                <NavLink
                    @click="closeMenu"
                    :active="{'nav-link-active': $page.component==='Adoptions'}"
                    :href="AdoptionsIndex()"
                    title="Adoptions"
                >
                    <Hearth :active="$page.component==='Adoptions'" />
                </NavLink>
                <NavLink
                    @click="closeMenu"
                    :active="{'nav-link-active': $page.component==='Users'}"
                    :href="UsersIndex()"
                    title="Utilisateurs"
                >
                    <User :active="$page.component==='Users'" />
                </NavLink>
                <NavLink
                    @click="closeMenu"
                    :active="{'nav-link-active': $page.component==='Notifications'}"
                    :href="NotificationsIndex()"
                    title="Notifications"
                    class="relative"
                >
                    <Notifications :active="$page.component==='Notifications'" />
                    <div class="absolute top-2 left-6 text-xs flex items-center text-center justify-center w-4 font-poppins font-normal aspect-square bg-main-red text-white rounded-full">
                        {{ $page.props.notificationCount }}
                    </div>
                </NavLink>
                <NavLink
                    @click="closeMenu"
                    :active="{'nav-link-active': $page.component==='Statistiques'}"
                    :href="StatistiquesIndex()"
                    title="Statistiques"
                >
                    <Statistiques :active="$page.component==='Statistiques'" />
                </NavLink>
                <NavLink
                    @click="closeMenu"
                    :active="{'nav-link-active': $page.component==='Database'}"
                    :href="DatabaseIndex()"
                    title="Base de données"
                >
                    <Database :active="$page.component==='Database'" />
                </NavLink>
            </div>

            <div class="w-full">
                <Link :href="edit()" @click="closeMenu" class="flex gap-2 p-4 items-center hover:bg-softGray/40 rounded-lg">
                    <span class="w-10 aspect-square bg-softGray rounded-full flex items-center justify-center">
                        {{ initials }}
                    </span>
                    <p class="flex flex-col text-sm">
                        {{ $page.props.auth.user.name }}
                        <span class="text-[10px] text-gray-500 truncate max-w-24">
                            {{ $page.props.auth.user.email }}
                        </span>
                    </p>
                </Link>
                <Link
                    :href="'/admin/logout'"
                    method="post"
                    as="button"
                    class="p-4 hover:bg-main-red-opacity rounded-lg text-main-red flex gap-2 w-full hover:cursor-pointer"
                >
                    <Logout />
                    Déconnexion
                </Link>
            </div>
        </nav>
        <nav
            aria-labelledby="desktop-nav"
            class="hidden md:flex col-start-1 col-end-3 h-screen border-r-2 border-r-gray-100 px-3.5 flex-col justify-between items-center py-10"
        >
            <h2 id="desktop-nav" class="sr-only">Navigation principale</h2>
            <NavLink :href="DashboardIndex()">
                <Logo classes="w-full" />
            </NavLink>

            <div class="flex flex-col gap-5 w-full">
                <NavLink :active="{'nav-link-active': $page.component==='Dashboard'}" :href="DashboardIndex()"
                         title="Dashboard">
                    <Dashboard :active="$page.component==='Dashboard'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Animals'}" :href="AnimalsIndex()"
                         title="Animaux">
                    <Paw classes="w-6" :active="$page.component==='Animals'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Adoptions'}" :href="AdoptionsIndex()"
                         title="Adoptions">
                    <Hearth :active="$page.component==='Adoptions'" />
                </NavLink>
                <NavLink v-if="$page.props.auth.user.role === 'Admin'" :active="{'nav-link-active': $page.component==='Users'}" :href="UsersIndex()"
                         title="Utilisateurs">
                    <User :active="$page.component==='Users'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Notifications'}" :href="NotificationsIndex()"
                         title="Notifications" class="relative">
                    <Notifications :active="$page.component==='Notifications'" />
                    <div
                        class="absolute top-2 left-6 text-xs flex items-center text-center justify-center w-4 font-poppins font-normal aspect-square bg-main-red text-white rounded-full">
                        {{ $page.props.notificationCount }}
                    </div>
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Statistiques'}" :href="StatistiquesIndex()"
                         title="Statistiques">
                    <Statistiques :active="$page.component==='Statistiques'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Database'}" :href="DatabaseIndex()"
                         title="Base de données">
                    <Database :active="$page.component==='Database'" />
                </NavLink>
            </div>

            <div class="w-full">
                <Link :href="edit()" class="flex gap-2 p-4 items-center hover:bg-softGray/40 rounded-lg">
                    <span class="w-10 aspect-square bg-softGray rounded-full flex items-center justify-center">
                        {{ initials }}
                    </span>
                    <p class="flex flex-col text-sm">
                        {{ $page.props.auth.user.name }}
                        <span class="text-[10px] text-gray-500 truncate max-w-24">
                            {{ $page.props.auth.user.email }}
                        </span>
                    </p>
                </Link>
                <Link
                    :href="'/admin/logout'"
                    method="post"
                    as="button"
                    class="p-4 hover:bg-main-red-opacity rounded-lg text-main-red flex gap-2 w-full hover:cursor-pointer"
                >
                    <Logout />
                    Déconnexion
                </Link>
            </div>
        </nav>
        <div class="pt-16 md:pt-0 md:col-start-3 md:col-end-13">
            <slot />
        </div>

        <Toaster />
    </div>
</template>
