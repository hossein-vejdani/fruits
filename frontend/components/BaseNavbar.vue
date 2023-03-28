<script setup lang="ts">
const items = ref([
    {
        title: 'fruits',
        to: '/'
    },
    {
        title: 'add new fruit',
        to: '/new'
    },
    {
        title: 'favorites',
        to: '/favorites'
    },
])
</script>
<template>
    <div class="navbar sticky top-3 bg-base-200 rounded-xl">
        <div class="flex-1">
            <img class="h-12" src="~~/assets/logo.png" />
            <span class="normal-case text-xl">Fruit</span>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li v-for="item in items" :key="item.title">
                    <NuxtLink :to="item.to" active-class="bg-primary text-primary-content"
                        class="block font-semi-bold text-lg py-1 px-3 mx-1">{{ item.title }}</NuxtLink>
                </li>
            </ul>
        </div>
    </div>
</template>
<style lang="scss" scoped></style>