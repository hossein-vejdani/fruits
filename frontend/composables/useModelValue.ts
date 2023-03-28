export function useModelValue<T>(
    props: {
        modelValue?: T
        [key: string]: unknown
    },
    emit: (event: 'update:modelValue', value?: T) => void,
    debounce?: number
) {
    let timeout: NodeJS.Timeout
    return computed({
        get: () => props.modelValue,
        set: (value?: T) => {
            clearTimeout(timeout)
            if (debounce) {
                timeout = setTimeout(() => {
                    emit('update:modelValue', value)
                }, debounce)
            } else {
                emit('update:modelValue', value)
            }
        }
    })
}
