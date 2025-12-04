<script setup lang="ts">
import Dashboard from '@/components/svgs/Dashboard.vue';
import Paw from '@/components/svgs/Paw.vue';
import Logo from '@/components/svgs/Logo.vue';
import Hearth from '@/components/svgs/Hearth.vue';
import User from '@/components/svgs/User.vue';
import Statistiques from '@/components/svgs/Statistiques.vue';
import Notifications from '@/components/svgs/Notifications.vue';
import Logout from '@/components/svgs/Logout.vue';
import NavLink from '@/components/nav/NavLink.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { index as DashboardIndex } from '@/actions/App/Http/Controllers/DashboardController';
import { index as AnimalsIndex } from '@/actions/App/Http/Controllers/AnimalsController';
import { index as AdoptionsIndex } from '@/actions/App/Http/Controllers/AdoptionsController';
import { index as UsersIndex } from '@/actions/App/Http/Controllers/UsersController';
import { index as NotificationsIndex } from '@/actions/App/Http/Controllers/NotificationsController';
import { index as StatistiquesIndex } from '@/actions/App/Http/Controllers/StatistiquesController';
import { edit } from '@/actions/App/Http/Controllers/Settings/ProfileController'


defineProps<{
    title?: string;
    description?: string;
}>();

const page = usePage();
const userName = page.props.auth.user.name;

const initials = userName
    .split(' ')
    .filter(n => n.length > 0)
    .map(n => n[0])
    .join('')
    .toUpperCase();

</script>

<template>
    <div class="grid grid-cols-12 gap-4">
        <Head :title="title" />
        <nav aria-labelledby="main-nav"
             class="col-start-1 col-end-3 h-screen border-r-2 border-r-gray-100 px-3.5 flex flex-col justify-between items-center py-10">
            <h2 id="main-nav" class="sr-only">Navigation principale</h2>
            <Logo classes="w-full" />
            <div class="flex flex-col gap-5 w-full">
                <NavLink :active="{'nav-link-active': $page.component==='Dashboard'}" :href="DashboardIndex()"
                         title="Dashboard">
                    <Dashboard :active="$page.component==='Dashboard'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Animals'}" :href="AnimalsIndex()" title="Animaux">
                    <Paw classes="w-6" :active="$page.component==='Animals'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Adoptions'}" :href="AdoptionsIndex()"
                         title="Adoptions">
                    <Hearth :active="$page.component==='Adoptions'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Users'}" :href="UsersIndex()"
                         title="Utilisateurs">
                    <User :active="$page.component==='Users'" />
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Notifications'}" :href="NotificationsIndex()"
                         title="Notifications" class="relative">
                    <Notifications :active="$page.component==='Notifications'"/>
                    <div class=" absolute top-2 left-6 text-xs flex items-center text-center justify-center w-4 font-poppins font-normal aspect-square bg-main-red text-white rounded-full">{{ $page.props.notificationCount }}</div>
                </NavLink>
                <NavLink :active="{'nav-link-active': $page.component==='Statistiques'}" :href="StatistiquesIndex()"
                         title="Statistiques">
                    <Statistiques :active="$page.component==='Statistiques'" />
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
                    :href="'/logout'"
                    method="post"
                    as="button"
                    class="p-4 hover:bg-main-red-opacity rounded-lg text-main-red flex gap-2 w-full"
                >
                    <Logout />
                    Déconnexion
                </Link>
            </div>

        </nav>
        <slot/>
    </div>
</template>
