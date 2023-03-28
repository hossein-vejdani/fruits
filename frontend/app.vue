<script setup lang="ts">
import BaseNavbar from './components/BaseNavbar.vue';
import BaseToast from './components/BaseToast.vue';

</script>
<template>
  <div class="container mx-auto pt-3">
    <BaseNavbar class="mb-5"></BaseNavbar>
    <main>
      <NuxtPage />
    </main>
    <BaseToast></BaseToast>
  </div>
</template>
