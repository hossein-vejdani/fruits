import { BASE_URL } from '~~/constants/config'

export function useFetchFruits<T>(route: string, options?: any) {
    return useFetch<T>(route, { baseURL: BASE_URL, ...options })
}
