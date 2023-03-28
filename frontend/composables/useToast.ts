export interface Message {
    type: 'success' | 'info'
    text: string
    timeout?: number
}
const messages = ref<Message[]>([])

export function useToast() {
    function add(data: Message) {
        messages.value.push(data)
        if (data.timeout)
            setTimeout(() => {
                const index = messages.value.findIndex(toast => toast === data)
                messages.value.splice(index, 1)
            }, data.timeout)
    }

    function removeAll() {
        messages.value = []
    }

    function remove(message: Message) {
        const index = messages.value.findIndex(toast => toast === message)
        messages.value.splice(index, 1)
    }

    return {
        add,
        removeAll,
        remove,
        messages
    }
}
