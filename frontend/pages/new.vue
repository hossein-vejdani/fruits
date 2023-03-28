<script setup lang="ts">
import BaseInput from '~~/components/BaseInput.vue';
import { Fruit } from '~~/models/Fruit';
import { useAddFruit } from '~~/composables/useAddFruit';
const data = reactive<Required<Omit<Fruit, 'id'>>>({
    name: '',
    family: '',
    genus: '',
    nutritions: {
        carbohydrates: undefined,
        protein: undefined,
        fat: undefined,
        calories: undefined,
        sugar: undefined,
    }
})

function sendData() {
    useAddFruit(data)
}
</script>
<template>
    <form @submit.prevent="sendData()">
        <div class="flex">
            <BaseInput label="name*" v-model="data.name" required maxLength="255" />
            <BaseInput label="family*" v-model="data.family" required maxLength="255" />
            <BaseInput label="genus*" v-model="data.genus" required maxLength="255" />
        </div>

        <p class="mt-5 text-xl">nutritions:</p>
        <div class="flex">
            <BaseInput label="carbohydrates" v-model="data.nutritions.carbohydrates" type="number" />
            <BaseInput label="protein" v-model="data.nutritions.protein" type="number" />
            <BaseInput label="fat" v-model="data.nutritions.fat" type="number" />
            <BaseInput label="calories" v-model="data.nutritions.calories" type="number" />
            <BaseInput label="sugar" v-model="data.nutritions.sugar" type="number" />
        </div>
        <button type="submit" class="btn btn-primary mt-6">submit</button>
    </form>
</template>
<style lang="scss"></style>