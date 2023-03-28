<script setup lang="ts">

export type Column = {
    title: string
    key: string
}

export interface Props {
    columns: Column[]
    items: {
        [key: string]: any
    }[],
    uniqueKey: string
    loading: boolean
}

const props = defineProps<Props>()

</script>
<template>
    <table class="table w-full">
        <thead>
            <tr class="sticky top-0">
                <th v-for="col in columns" :key="col.key">
                    {{ col.title }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="loading">
                <th :colspan="columns.length" class="text-center text-lg">loading...</th>
            </tr>
            <tr v-else-if="!items.length">
                <th :colspan="columns.length" class="text-center text-lg">list is empty</th>
            </tr>
            <tr v-else v-for="item in items" :key="item[uniqueKey]">
                <template v-for="col in columns" :key="`${col.key}${item[uniqueKey]}`">
                    <slot :name="col.key" :item="item">
                        <td>{{ item[col.key] }}</td>
                    </slot>
                </template>
            </tr>
        </tbody>
    </table>
</template>