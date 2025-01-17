<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="w-full bg-maincolor py-2 px-4 h-20 flex justify-between">
        <div class="flex items-center md:gap-2">
            <img src="../images/cosmine.png" alt="logo" class="w-14 h-14">
            <h1 class="text-sm md:text-xl font-bold text-white">Cosmine</h1>
        </div>
        <div class="flex items-center gap-4 text-white font-bold">
            <Link :href="route('register')" class="w-20 md:w-28 flex items-center justify-center rounded-lg h-10 bg-white text-maincolor">
                Register
            </Link>
            <Link :href="route('login')" class="w-20 md:w-28 flex items-center justify-center rounded-lg h-10 bg-white text-maincolor">
                Login
            </Link>
        </div>
    </nav>
</template>