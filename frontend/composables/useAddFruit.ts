import { BASE_URL } from '~~/constants/config'
import { Fruit } from '~~/models/Fruit'

const { add: showMessage } = useToast()
export async function useAddFruit(fruit: Omit<Fruit, 'id'>) {
    const { data, error } = await useFetch('/fruit', {
        method: 'POST',
        baseURL: BASE_URL,
        body: { ...fruit }
    })
    if (error) {
        error.value?.data.errors.forEach((err: string) => {
            showMessage({
                text: err,
                type: 'info',
                timeout: 3000
            })
        })
        return null
    }
    return data
}
