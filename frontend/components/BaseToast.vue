<script setup lang="ts">
import { useToast } from '~~/composables/useToast';
const { messages, remove } = useToast()
</script>
<template>
    <div class="toast toast-start toast-bottom">
        <div v-for="message in messages" :class="`alert alert-${message.type || 'info'}`">
            <div>
                <div class="min-w-[15vw]">{{ message.text }}</div>
                <button @click="remove(message)" class="btn btn-xs">close</button>
            </div>
        </div>
    </div>
</template>