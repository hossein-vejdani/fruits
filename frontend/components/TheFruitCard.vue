<script setup lang="ts">
import { Fruit } from '~~/models/Fruit';

interface Props {
    fruit: Fruit
}

const emit = defineEmits<{
    (e: 'remove', value: Fruit): void
}>()

const props = defineProps<Props>()

const imageSrc = ref<string>('')
async function getImage() {
    const image = await useGetImage(props.fruit.name)
    imageSrc.value = image.webformatURL
}

onMounted(() => {
    getImage()
})

function removeFruit(fruit: Fruit) {
    emit('remove', fruit)
}

</script>
<template>
    <div class="card card-side bg-base-100 shadow-xl">
        <figure class="w-[60%]"><img class="h-72" :src="imageSrc" /></figure>
        <div class="card-body">
            <h2 class="card-title font-bold">{{ fruit.name }} {{ fruit.family }}</h2>
            <p class="text-gray-500 mb-3">{{ fruit.genus }}</p>
            <div class="flex gap-2 flex-wrap">
                <button v-for="(value, key) in fruit.nutritions" class="btn gap-2 btn-sm">
                    {{ key }}
                    <div class="badge badge-primary">{{ value }}</div>
                </button>
            </div>
            <div class="card-actions justify-end">
                <button @click="removeFruit(fruit)" class="btn btn-error btn-sm">remove</button>
            </div>
        </div>
    </div>
</template>