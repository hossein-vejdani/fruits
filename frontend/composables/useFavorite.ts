import { Fruit } from '~~/models/Fruit'
import { useToast } from './useToast'
const TIMEOUT = 3000
export function useFavorite() {
    const favorites = ref<Fruit[]>([])
    const { add: showMessage } = useToast()
    onMounted(() => {
        favorites.value = JSON.parse(localStorage.getItem('favorites') || '[]')
        console.log(favorites.value)
    })

    function addToFavorite(fruit: Fruit) {
        const isExist = favorites.value.some(item => item.id === fruit.id)
        if (isExist) {
            showMessage({
                text: `${fruit.name} already exist in favorites!`,
                type: 'info',
                timeout: TIMEOUT
            })
        } else {
            favorites.value.push(fruit)
            showMessage({
                text: `${fruit.name} successfully added to favorites!`,
                type: 'success',
                timeout: TIMEOUT
            })
            if (favorites.value.length > 10) {
                const removedFruit = favorites.value.shift()
                showMessage({
                    text: `${removedFruit?.name} removed from favorites!`,
                    type: 'info',
                    timeout: TIMEOUT
                })
            }
            localStorage.setItem('favorites', JSON.stringify(favorites.value))
        }
    }

    function removeFromFavorite(id: number) {
        const index = favorites.value.findIndex(item => item.id === id)
        console.log(index)

        const [fruit] = favorites.value.splice(index, 1)
        showMessage({
            text: `${fruit.name} removed to favorites!`,
            type: 'info',
            timeout: TIMEOUT
        })
        localStorage.setItem('favorites', JSON.stringify(favorites.value))
    }

    return {
        removeFromFavorite,
        addToFavorite,
        favorites
    }
}
