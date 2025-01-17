<script setup>
import { Link } from '@inertiajs/vue3';
import TextInput from '../../Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
})

const submit = () => {
    form.post(route('login'), {
        preserveScroll: true,
    })
}
</script>

<template>
    <div class="flex flex-col items-center h-screen bg-slate-200">
        <header class="w-full h-20 bg-maincolor flex items-center justify-start px-4">
            <Link :href="route('landing')" class="flex items-center gap-2 cursor-pointer">
                <img src="../../images/cosmine.png" alt="logo" class="w-14 h-14">
                <h1 class="text-xl font-bold text-white">Cosmine</h1>
            </Link>
        </header>
        <h1 class="font-bold mt-2 text-3xl text-maincolor">Login</h1>
        <form @submit.prevent="submit" class="flex flex-col items-center justify-center h-1/2 gap-4 mt-4 bg-maincolor w-11/12 lg:w-1/2 rounded-lg my-6">
            <TextInput 
                name="Email" 
                type="email" 
                placeholder="Email" 
                v-model="form.email"
                :message="form.errors.email"
            />
            <TextInput 
                name="Password" 
                type="password" 
                placeholder="Password" 
                v-model="form.password"
                :message="form.errors.password"
            />
            <button type="submit" class="w-28 flex items-center justify-center font-bold rounded-lg p-2 mb-6 bg-white text-maincolor hover:bg-slate-200">Login</button>
        </form>
    </div>
</template>