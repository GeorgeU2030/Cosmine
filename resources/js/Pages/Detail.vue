<script setup>
import Navbar from '../Components/Navbar.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    item: Object,
    type: String
});

const selectedRating = ref(null);
const loading = ref(false);
const error = ref(null);

const selectRating = (rating) => {
    selectedRating.value = rating;
};

const submitRating = () => {
    if (!selectedRating.value) {
        error.value = 'Please select a rating first';
        return;
    }

    loading.value = true;
    error.value = null;

    router.post('/save-rating', {
        id: props.item.id,
        type: props.type,
        rating: selectedRating.value,
        name: props.item.title || props.item.name,
        cover: props.item.poster_path,
        release_date: props.item.release_date || props.item.first_air_date
    }, {
        onSuccess: () => {
            loading.value = false;
        },
        onError: (errors) => {
            loading.value = false;
            error.value = Object.values(errors)[0];
        }
    });
};


</script>

<template>
    <div class="flex flex-col min-h-screen">
        <Navbar />
        
        <div class="container mx-auto px-4 py-8 bg-slate-200 flex-grow">
            <div v-if="$page.props.flash.message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4 mb-4" role="alert">
                <span class="block sm:inline">{{ $page.props.flash.message }}</span>
            </div>
            <div v-if="item" class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-1/3 flex items-center justify-center">
                    <img 
                        :src="'https://image.tmdb.org/t/p/w500' + item.poster_path" 
                        :alt="item.title || item.name"
                        class="w-80 rounded-lg shadow-lg border-2 border-maincolor"
                    >
                </div>
                <div class="w-full md:w-2/3">
                    <h1 class="text-3xl font-bold mb-4">{{ item.title || item.name }}</h1>
                    <div class="text-lg mb-4">
                        <span class="font-semibold">Rating:</span> {{ item.vote_average?.toFixed(1) }}/10
                    </div>
                    <div class="text-lg mb-4">
                        <span class="font-semibold">Release Date:</span> 
                        {{ item.release_date || item.first_air_date }}
                    </div>
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Overview</h2>
                        <p class="text-gray-700" v-if="item.overview !== ''" >{{ item.overview }}</p>
                        <p class="text-gray-700" v-else>No overview available</p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Genres</h2>
                        <div class="flex flex-wrap gap-2">
                            <span 
                                v-for="genre in item.genres" 
                                :key="genre.id"
                                class="px-3 py-1 bg-maincolor text-white rounded-full text-sm"
                            >
                                {{ genre.name }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold mb-2 text-maincolor">Select a Rating</h2>
                        <div class="flex gap-4 justify-center items-center">
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Eternity')"
                                    :class="['bg-gradient-to-r from-black via-maincolor to-black rounded-lg p-2', 
                                            {'border-2 border-blue-500': selectedRating === 'Eternity'}]"
                                >
                                    <img src="../images/cosmine.png" class="w-12 h-12"/>
                                </button>
                                <h1>Eternity</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28 ">
                                <button 
                                    @click="selectRating('Masterpiece')"
                                    :class="['bg-[#ce9d05] rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Masterpiece'}]"
                                >
                                    <img src="../images/star.png" class="w-12 h-12"/>
                                </button>
                                <h1>Masterpiece</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Excellent')"
                                    :class="['bg-violet-700 rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Excellent'}]"
                                >
                                    <img src="../images/excellent.png" class="w-12 h-12"/>
                                </button>
                                <h1>Excellent</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Great')"
                                    :class="['bg-sky-400 rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Great'}]"
                                >
                                    <img src="../images/glasses.png" class="w-12 h-12"/>
                                </button>
                                <h1>Great</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Good')"
                                    :class="['bg-[#14b475] rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Good'}]"
                                >
                                    <img src="../images/good.png" class="w-12 h-12"/>
                                </button>
                                <h1>Good</h1>
                            </div>
                        </div>
                        <div class="flex gap-4 justify-center items-center mt-2">
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Decent')"
                                    :class="['bg-[#a6ff35] rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Decent'}]"
                                >
                                    <img src="../images/like.png" class="w-12 h-12"/>
                                </button>
                                <h1>Decent</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28 ">
                                <button 
                                    @click="selectRating('Mediocre')"
                                    :class="['bg-[#e4e100] rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Mediocre'}]"
                                >
                                    <img src="../images/dislike.png" class="w-12 h-12"/>
                                </button>
                                <h1>Mediocre</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Boring')"
                                    :class="['bg-orange-500 rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Boring'}]"
                                >
                                    <img src="../images/zzz.png" class="w-12 h-12"/>
                                </button>
                                <h1>Boring</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Trash')"
                                    :class="['bg-red-300 rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Trash'}]"
                                >
                                    <img src="../images/trash.png" class="w-12 h-12"/>
                                </button>
                                <h1>Trash</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center w-28">
                                <button 
                                    @click="selectRating('Razzie')"
                                    :class="['bg-[#ce8144] rounded-lg p-2',
                                            {'border-2 border-blue-500': selectedRating === 'Razzie'}]"
                                >
                                    <img src="../images/razzie.png" class="w-12 h-12"/>
                                </button>
                                <h1>Razzie</h1>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-3">
                        <button 
                            @click="submitRating"
                            :disabled="loading"
                            class="w-28 flex items-center justify-center font-bold rounded-lg p-2 mb-6 bg-maincolor text-white hover:bg-violet-500 disabled:opacity-50"
                        >
                            {{ loading ? 'Saving...' : 'Rate' }}
                        </button>
                    </div>
                    <div v-if="error" class="text-red-500 text-center mb-4">
                        {{ error }}
                    </div>
                    <div v-if="type == 'tv' && item.number_of_seasons" class="mb-6 flex flex-col">
                        <h2 class="text-xl font-semibold mb-2">Seasons</h2>
                        <div class="flex w-full flex-wrap justify-center lg:justify-start gap-1 lg:gap-2">
                            <div
                                v-for="season in item.seasons" 
                                :key="season.id"
                                class="px-1 lg:px-3 py-1 bg-maincolor text-white rounded-lg text-sm flex flex-col items-center justify-center w-28" 
                            >
                                <span>Season {{ season.season_number }}</span>
                                <span>{{ season.episode_count }} episodes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="text-center text-red-500">
                Failed to load details
            </div>
        </div>
    </div>
</template>