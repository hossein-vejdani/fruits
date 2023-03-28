export interface PaginatedData<T> {
    items: T[]
    totalElements: number
    offset: number
    limit: number
}
