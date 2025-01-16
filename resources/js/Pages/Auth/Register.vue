<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col h-screen bg-slate-200">
        <header class="w-full h-20 bg-maincolor flex items-center justify-start px-4">
            <Link :href="route('landing')" class="flex items-center gap-2 cursor-pointer">
                <img src="../../images/cosmine.png" alt="logo" class="w-14 h-14">
                <h1 class="text-xl font-bold text-white">Cosmine</h1>
            </Link>
        </header>
        <form>
            
        </form>
    </div>
</template>