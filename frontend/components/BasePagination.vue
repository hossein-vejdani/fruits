<script setup lang="ts">

export interface Props {
    totalItems: number;
}

const props = defineProps<Props>()

const emit = defineEmits<{
    (e: 'change', data: { limit: number, offset: number }): void
}>()

const currentPage = ref<number>(1)
const left = ref<number>(0);
const right = ref<number>(0)
const pages = ref<(number | string)[]>()
const limit = ref<number>(10);
const totalPages = ref<number>(0)

watch([() => props.totalItems, currentPage, limit], () => {
    totalPages.value = Math.ceil(props.totalItems / limit.value)
    calculatePages()
}, { immediate: true })

watch(limit, () => {
    changePage(currentPage.value)
})


function calculatePages() {
    left.value = currentPage.value - 2
    right.value = currentPage.value + 2;
    if (left.value <= 0) {
        right.value += left.value === 0 ? 1 : 2
        left.value = 1
    }
    if (right.value > totalPages.value) right.value = totalPages.value;
    pages.value = []
    for (let i = left.value; i <= right.value; i++) {
        pages.value.push(i);
    }
}

function changePage(page: number | string) {
    currentPage.value = +page
    emit('change', {
        limit: limit.value,
        offset: (+page - 1) * limit.value
    })
}


function nextPage() {
    if (currentPage.value < totalPages.value) {
        changePage(currentPage.value + 1)
    }
}

function prevPage() {
    if (currentPage.value > 1) {
        changePage(currentPage.value - 1)
    }
}
</script>
<template>
    <div class="flex p-3">
        <div class="btn-group">
            <button @click="prevPage()" class="btn">prev</button>
            <button v-for="i in pages" @click="changePage(i)" :class="{
                'btn': true,
                'btn-active': i === currentPage
            }">
                {{ i }}
            </button>
            <button @click="nextPage()" class="btn">next</button>
        </div>
        <label class="label ml-3 mr-1">
            <span class="label-text">limit</span>
        </label>
        <select v-model="limit" class="select select-primary max-w-xs">
            <option :value="10">10</option>
            <option :value="20">20</option>
            <option :value="50">50</option>
        </select>
    </div>
</template>