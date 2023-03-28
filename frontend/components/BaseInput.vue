<script setup lang="ts">
import { useModelValue } from '~~/composables/useModelValue'
export interface Props {
    label: string;
    modelValue?: any;
    debounce?: number;
}

const props = defineProps<Props>()
const emit = defineEmits<{
    (e: 'update:modelValue', value?: any): void
}>()

const value = useModelValue<any>(props, emit, props.debounce)
</script>
<template>
    <div>
        <label class="label flex-col items-start">
            <span class="label-text text-lg">{{ label }}</span>
            <input v-model="value" type="text" class="input input-bordered input-sm input-primary w-full max-w-xs"
                v-bind="$attrs" />
        </label>
    </div>
</template>