<script setup>
import { ref, onMounted, computed } from 'vue'
import { Link } from '@inertiajs/vue3'

// images
import eternityIcon from '../images/cosmine.png'
import masterIcon from '../images/star.png'
import excellentIcon from '../images/excellent.png'
import greatIcon from '../images/glasses.png'
import goodIcon from '../images/good.png'
import decentIcon from '../images/like.png'
import mediocreIcon from '../images/dislike.png'
import boringIcon from '../images/zzz.png'
import trashIcon from '../images/trash.png'
import razzieIcon from '../images/razzie.png'

const rankings = ref([])

const getRatingImage = (rating) => {
    const images = {
        'Eternity': eternityIcon,
        'Masterpiece': masterIcon,
        'Excellent': excellentIcon,
        'Great': greatIcon,
        'Good': goodIcon,
        'Decent': decentIcon,
        'Mediocre': mediocreIcon,
        'Boring': boringIcon,
        'Trash': trashIcon,
        'Razzie': razzieIcon
    }
    return images[rating]
}

const getRatingColor = (rating) => {
    const colors = {
        'Eternity': 'bg-yellow-500',
        'Masterpiece': 'bg-purple-600',
        'Excellent': 'bg-blue-500',
        'Great': 'bg-green-500',
        'Good': 'bg-teal-500',
        'Decent': 'bg-cyan-500',
        'Mediocre': 'bg-orange-500',
        'Boring': 'bg-gray-500',
        'Trash': 'bg-red-500',
        'Razzie': 'bg-red-700'
    }
    return colors[rating] || 'bg-gray-300'
}

const moviesByYear = computed(() => {
    const grouped = {}
    rankings.value.forEach(ranking => {
        const year = ranking.year
        if (!grouped[year]) {
            grouped[year] = []
        }
        grouped[year].push(ranking)
    })
    return grouped
})

const fetchRankings = async () => {
    try {
        const response = await fetch('/movie-rankings')
        rankings.value = await response.json()
        console.log(rankings.value)
    } catch (error) {
        console.error('Error al obtener los rankings:', error)
    }
}

onMounted(() => {
    fetchRankings()
})
</script>
<template>
    <div class="min-h-screen flex flex-col items-center justify-center bg-slate-200">
        <header class="w-full h-20 bg-maincolor flex items-center justify-between px-4">
            <Link href="/home" class="flex items-center gap-2 cursor-pointer">
                <img :src="eternityIcon" alt="logo" class="w-14 h-14">
                <h1 class="text-xl font-bold text-white">Cosmine</h1>
            </Link>
            <div>
                <img :src="$page.props.auth.user.avatar" alt="avatar" class="w-14 h-14 bg-white rounded-full"/>
            </div>
        </header>
        <div class="container mx-auto p-6 flex flex-col flex-grow">
            <h1 class="text-2xl font-bold mb-4 text-maincolor">My Rating Movies</h1>
            <div v-for="(yearMovies, year) in moviesByYear" :key="year" class="mb-8">
                <h2 class="text-xl font-semibold mb-4">{{ year }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                    <div v-for="ranking in yearMovies" :key="ranking.id" 
                    class="group relative transition-all duration-300 hover:scale-105 border-2 border-maincolor rounded-xl">
                    <!-- Card Container -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300">
                    <!-- Overlay image hover -->
                        <div class="relative">
                            <img :src="'https://image.tmdb.org/t/p/w200' + ranking.rankable.cover"
                                :alt="ranking.rankable.title"
                                class="w-full h-72 object-cover transition-transform duration-300 group-hover:brightness-75">
                            
                            <!-- Rating Badge Float -->
                            <div class="absolute top-4 right-4 flex items-center gap-2 bg-black/70 rounded-full px-4 py-2 text-white">
                            <span class="text-lg font-bold">{{ ranking.rating }}</span>
                            <img :src="getRatingImage(ranking.rating)"
                                :alt="ranking.rating"
                                class="w-12 h-12 p-2 rounded-lg" 
                                :class="getRatingColor(ranking.rating)">
                            </div>
                        </div>

                    <!-- Content -->
                        <div class="h-16 flex items-center px-2">
                            <h3 class="font-semibold text-center line-clamp-2 hover:line-clamp-none transition-all">
                                {{ ranking.rankable.name }}
                            </h3>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>