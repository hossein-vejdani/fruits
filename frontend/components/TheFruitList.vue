<script setup lang="ts">
import { Fruit } from '~~/models/Fruit'
import { PaginatedData } from '~~/models/PaginatedData'
import { useFetchFruits } from '~~/composables/useFetchFruits'
import { useGetImage } from '~~/composables/useGetImage'
import { useFavorite } from '~~/composables/useFavorite'
import BaseInput from './BaseInput.vue';
import BasePagination from './BasePagination.vue';

type Filter = Partial<Omit<Fruit, 'id' | 'nutritions'>> & { limit: number, offset: number }

const { addToFavorite } = useFavorite()

const params = reactive<Filter>({
    limit: 10,
    offset: 0,
})

const images = ref<{ [key: string]: string }>({})

const columns = [
    {
        key: 'image',
        title: '',
    },
    {
        key: 'name',
        title: 'name',
    },
    {
        key: 'family',
        title: 'family',
    },
    {
        key: 'genus',
        title: 'genus',
    },
    {
        key: 'actions',
        title: 'actions',
    },
]

const { data: fruits, refresh, pending } = await useFetchFruits<PaginatedData<Fruit>>('/fruit', {
    params,
})
watch(params, () => {
    refresh()
})

watch(fruits, (value) => {

    value?.items.forEach(item => {
        getImage(item.name)
    })
}, { immediate: true })

function changePage({ limit, offset }: { limit: number, offset: number }) {
    params.limit = limit
    params.offset = offset
}

async function getImage(name: string) {
    const image = await useGetImage(name)
    images.value[name] = image.previewURL
}


</script>
<template>
    <div class="overflow-x-auto">
        <div class="flex gap-x-3">
            <BaseInput label="name" v-model="params.name" :debounce="1000" />
            <BaseInput label="family" v-model="params.family" :debounce="1000" />
            <BaseInput label="genus" v-model="params.genus" :debounce="1000" />
        </div>
        <div class="h-[70vh] overflow-y-auto">
            <BaseTable :items="fruits?.items || []" :columns="columns" unique-key="id" :loading="pending">
                <template #image="{ item }">
                    <td>
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img :src="images[item.name]" />
                            </div>
                        </div>
                    </td>
                </template>
                <template #actions="{ item }">
                    <td>
                        <button @click="addToFavorite(item as Fruit)" class="btn btn-warning btn-sm">Add to
                            favorite</button>
                    </td>
                </template>
            </BaseTable>
        </div>
        <div class="flex justify-center mt-5">
            <BasePagination @change="changePage" :total-items="fruits?.totalElements || 0" />
        </div>
    </div>
</template>