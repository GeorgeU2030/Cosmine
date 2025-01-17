<script setup>
import Navbar from '../Components/Navbar.vue';
</script>

<template>
    <div class="flex flex-col h-screen bg-slate-200">
        <Navbar />
        <div class="flex flex-col lg:flex-row flex-grow">
            <section class="flex flex-col py-6 lg:py-0 h-full w-full md:w-1/2 items-center justify-center">
                <h1 class="text-maincolor text-4xl font-bold">Welcome to Cosmine</h1>
                <p class="text-center w-3/4 mt-3">
                    Discover Movies. Express Your Opinion. Earn Badges.

                    At Cosmine, we believe that every movie has a story to tell, and every opinion deserves to be recognized. Our innovative badge system allows you to rate movies based on their true worth, with each film earning a special badge that reflects your unique perspective.

                    Whether you’re a casual viewer or a cinematic enthusiast, Cosmine helps you express your thoughts through 10 distinct badges, each representing a different level of excellence.
                </p>
            </section>
            <section class="flex h-full w-full md:w-1/2 items-center justify-center">
                <img src="../images/landing.avif" alt="landing"/>
            </section>
        </div>
    </div>
</template>
