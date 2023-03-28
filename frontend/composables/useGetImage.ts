import { BASE_IMAGE_URL, IMAGE_KEY } from '~~/constants/config'

type Hit = { previewURL: string; largeImageURL: string; webformatURL: string }
type Image = {
    hits: Hit[]
}
export async function useGetImage(name: string): Promise<Hit> {
    const q =
        name
            .replace(/(?:^|\.?)([A-Z])/g, function (x, y) {
                return ' ' + y.toLowerCase()
            })
            .replace(/^ /, ' ') + ' fruit'

    const data = await $fetch<Image>('', {
        method: 'GET',
        baseURL: BASE_IMAGE_URL,
        params: {
            key: IMAGE_KEY,
            q,
            image_type: 'photo',
            page: 1,
            per_page: 20
        }
    })
    const index = Math.ceil(Math.random() * data.hits.length) - 1
    return data.hits[index]
}
