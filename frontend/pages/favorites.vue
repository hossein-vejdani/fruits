<script setup>
import TheFavoriteList from '~~/components/TheFavoriteList.vue';

</script>
<template>
    <ClientOnly fallback-tag="span" fallback="Loading favorites...">
        <TheFavoriteList />
    </ClientOnly>
</template>