<script setup>

const model = defineModel({
    type: null,
    required: true
})

defineProps({
    name: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: 'text'
    },
    message: String
})
</script>

<template>
    <div class="mb-4 w-3/4 lg:w-1/2">
        <label :for="name" class="block mb-2 font-bold text-white">{{ name }}</label>
        <input :type="type" :name="name" :id="name" class="border border-indigo-300 p-2 w-full rounded-lg" v-model="model">
        <small class="text-white" v-if="message">{{ message }}</small>
    </div>
</template>
