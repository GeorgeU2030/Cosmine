<script setup>
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';

import { defineProps } from 'vue';

const props = defineProps({
  popularMovies: Array,
  popularTVShows: Array,
});

console.log(props.popularMovies);

</script>
<template>
    <div class="flex flex-col items-center min-h-screen bg-slate-200">
        <Navbar />
        <div class="flex flex-col lg:flex-row flex-grow w-full p-6">
            <div class="w-full">
                <h1 class="font-bold mb-6 text-2xl text-maincolor">Welcome {{ $page.props.auth.user.name }}</h1>
                
                <!-- Popular Movies Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Popular Movies</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div v-for="movie in popularMovies" :key="movie.id" class="bg-white rounded-lg shadow-md overflow-hidden border border-maincolor cursor-pointer">
                            <img :src="'https://image.tmdb.org/t/p/w500' + movie.poster_path" :alt="movie.title" class="w-full h-72 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold h-12">{{ movie.title }}</h3>
                                <p class="text-sm text-gray-600">{{ movie.release_date }}</p>
                                <div class="mt-2 text-sm">
                                    Rating: {{ movie.vote_average.toFixed(1) }}/10
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular TV Shows Section -->
                <div class="mt-16">
                    <h2 class="text-xl font-semibold mb-4">Popular TV Shows</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div v-for="show in popularTVShows" :key="show.id" class="bg-white rounded-lg shadow-md overflow-hidden border border-maincolor cursor-pointer">
                            <img :src="'https://image.tmdb.org/t/p/w500' + show.poster_path" :alt="show.name" class="w-full h-72 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold h-12">{{ show.name }}</h3>
                                <p class="text-sm text-gray-600">{{ show.first_air_date }}</p>
                                <div class="mt-2 text-sm">
                                    Rating: {{ show.vote_average.toFixed(1) }}/10
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>