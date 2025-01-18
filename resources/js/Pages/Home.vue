<script setup>
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';

import { defineProps, ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';

const props = defineProps({
  popularMovies: Array,
  popularTVShows: Array,
  searchMovies: Array
});

const searchQuery = ref('');
const searchResults = ref([]);
const isLoading = ref(false);

const searchMedia = async () => {
  if (!searchQuery.value.trim()) return;
  
  isLoading.value = true;
  try {
    const response = await fetch(`/api/search?query=${encodeURIComponent(searchQuery.value)}`);
    const data = await response.json();
    searchResults.value = data.results;
  } catch (error) {
    console.error('Error searching:', error);
  } finally {
    isLoading.value = false;
  }
};

</script>
<template>
    <div class="flex flex-col items-center min-h-screen bg-slate-200">
        <Navbar />
        <div class="flex flex-col lg:flex-row flex-grow w-full p-6">
            <div class="w-full">
                <div class="flex items-center justify-between mb-6">
                    <Link href="/home" class="font-bold mb-6 text-2xl text-maincolor">Welcome {{ $page.props.auth.user.name }}</Link>
                    <div class="flex gap-2">
                        <input 
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search movies or TV shows..."
                            class="px-4 py-2 border border-maincolor rounded-lg focus:outline-none focus:border-maincolor"
                            @keyup.enter="searchMedia"
                        />
                        <button 
                            @click="searchMedia"
                            class="px-4 py-2 bg-maincolor text-white rounded-lg hover:bg-opacity-90 transition-colors"
                            :disabled="isLoading"
                        >
                            {{ isLoading ? 'Searching...' : 'Search' }}
                        </button>
                    </div>
                </div>

                <!-- Search Results -->
                <div v-if="searchResults.length > 0" class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Search Results</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div v-for="item in searchResults" 
                             :key="item.id" 
                             @click="() => router.visit(`/detail/${item.media_type}/${item.id}`)"
                             class="bg-white rounded-lg shadow-md overflow-hidden border border-maincolor cursor-pointer hover:shadow-xl transition-shadow">
                            <img :src="item.poster_path ? 'https://image.tmdb.org/t/p/w500' + item.poster_path : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeDP37vMYgkI-FLO2_vGo9qGp1SltyyuRSiaYQI7yVBaLKoNXJ6LDD7wGxTrrZBPkSwV0&usqp=CAU'" 
                                :alt="item.title || item.name" 
                                class="w-full h-72 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold h-12">{{ item.title || item.name }}</h3>
                                <p class="text-sm text-gray-600">{{ item.release_date || item.first_air_date }}</p>
                                <div class="mt-2 text-sm">
                                    Rating: {{ item.vote_average.toFixed(1) }}/10
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Movies Section -->
                <div v-if="searchResults.length === 0" class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Popular Movies</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div v-for="movie in popularMovies" 
                             :key="movie.id" 
                             @click="() => router.visit(`/detail/movie/${movie.id}`)"
                             class="bg-white rounded-lg shadow-md overflow-hidden border border-maincolor cursor-pointer hover:shadow-xl transition-shadow">
                            <img :src="movie.poster_path ? 'https://image.tmdb.org/t/p/w500' + movie.poster_path : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeDP37vMYgkI-FLO2_vGo9qGp1SltyyuRSiaYQI7yVBaLKoNXJ6LDD7wGxTrrZBPkSwV0&usqp=CAU'" 
                                :alt="movie.title" 
                                class="w-full h-72 object-cover">
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
                <div v-if="searchResults.length === 0" class="mt-16">
                    <h2 class="text-xl font-semibold mb-4">Popular TV Shows</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div v-for="show in popularTVShows" 
                             :key="show.id" 
                             @click="() => router.visit(`/detail/tv/${show.id}`)"
                             class="bg-white rounded-lg shadow-md overflow-hidden border border-maincolor cursor-pointer hover:shadow-xl transition-shadow">
                            <img :src="show.poster_path ? 'https://image.tmdb.org/t/p/w500' + show.poster_path : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeDP37vMYgkI-FLO2_vGo9qGp1SltyyuRSiaYQI7yVBaLKoNXJ6LDD7wGxTrrZBPkSwV0&usqp=CAU'" 
                                :alt="show.name" 
                                class="w-full h-72 object-cover">
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