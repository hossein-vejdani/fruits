<script setup lang="ts">
import TheFruitCard from './TheFruitCard.vue';

const { favorites, removeFromFavorite } = useFavorite()
</script>
<template>
    <div>
        <p v-if="!favorites.length" class="text-lg text-center">favorite list is empty!</p>
        <div v-else class="grid grid-cols-2 gap-5 my-10">
            <TheFruitCard v-for="fruit in favorites" :fruit="fruit" :key="fruit.id" @remove="removeFromFavorite($event.id)">
            </TheFruitCard>
        </div>
    </div>
</template>