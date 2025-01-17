<script setup>
import { Link } from '@inertiajs/vue3';
import TextInput from '../../Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: 'https://static-00.iconduck.com/assets.00/profile-default-icon-2048x2045-u3j7s5nj.png',
})

const change = (e) => {
    form.avatar = e.target.value ?? ('https://static-00.iconduck.com/assets.00/profile-default-icon-2048x2045-u3j7s5nj.png');
}

const submit = () => {
    console.log('Enviando datos:', form.data())
    
    form.post(route('register'), {
        onError: (errors) => {
            console.error('Errores de validación:', errors)
            form.reset('password', 'password_confirmation')
        },
        onSuccess: () => {
            console.log('Usuario registrado correctamente')
        },
        preserveScroll: true,
    })
}
</script>

<template>
    <div class="flex flex-col items-center min-h-screen bg-slate-200">
        <header class="w-full h-20 bg-maincolor flex items-center justify-start px-4">
            <Link :href="route('landing')" class="flex items-center gap-2 cursor-pointer">
                <img src="../../images/cosmine.png" alt="logo" class="w-14 h-14">
                <h1 class="text-xl font-bold text-white">Cosmine</h1>
            </Link>
        </header>
        <h1 class="font-bold mt-2 text-3xl text-maincolor">Register</h1>
        <form @submit.prevent="submit" class="flex flex-col items-center gap-4 mt-4 bg-maincolor w-1/2 rounded-lg my-6">

            <img :src="form.avatar" alt="avatar" class="w-16 mt-2 h-16 rounded-full bg-white" @input="change">

            <input type="url" placeholder="Avatar URL" class="border border-gray-400 p-2 w-1/2 rounded-lg">

            <TextInput 
                name="Name" 
                type="text" 
                placeholder="Name" 
                v-model="form.name"
                :message="form.errors.name"
            />
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
            <TextInput 
                name="Password Confirmation" 
                type="password" 
                placeholder="Password Confirmation" 
                v-model="form.password_confirmation"
                :message="form.errors.password_confirmation"
            />
            
            <button type="submit" class="w-28 flex items-center justify-center font-bold rounded-lg p-2 mb-6 bg-white text-maincolor hover:bg-slate-200">Register</button>
        </form>
    </div>
</template>