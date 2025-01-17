<script setup>
import { Link } from '@inertiajs/vue3';
import { LogOut } from 'lucide-vue-next';
</script>

<template>
    <nav class="w-full bg-maincolor py-2 px-4 h-20 flex justify-between">
        <div class="flex items-center md:gap-2">
            <img src="../images/cosmine.png" alt="logo" class="w-14 h-14">
            <h1 class="text-sm md:text-xl font-bold text-white">Cosmine</h1>
        </div>
        <div v-if="$page.props.auth.user" class="flex items-center gap-4 text-white font-bold">
            <Link class="px-2 md:w-28 flex items-center justify-center rounded-lg h-10 bg-white text-maincolor
            hover:bg-slate-200">
                Movies
            </Link>
            <Link class="px-2 md:w-28 flex items-center justify-center rounded-lg h-10 bg-white text-maincolor hover:bg-slate-200">
                TV Shows
            </Link>
            <Link :href="route('logout')" class="px-2 flex items-center justify-center rounded-lg h-10 bg-white text-maincolor hover:bg-slate-200" method="post" as="button" type="button">
                <LogOut />
            </Link>
        </div>
        <div v-else class="flex items-center gap-4 text-white font-bold">
            <Link :href="route('register')" class="w-20 md:w-28 flex items-center justify-center rounded-lg h-10 bg-white text-maincolor hover:bg-slate-200">
                Register
            </Link>
            <Link :href="route('login')" class="w-20 md:w-28 flex items-center justify-center rounded-lg h-10 bg-white text-maincolor hover:bg-slate-200">
                Login
            </Link>
        </div>
    </nav>
</template>