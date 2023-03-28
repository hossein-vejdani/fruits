export interface Fruit {
    id: number
    name: string
    family: string
    genus: string
    nutritions?: {
        carbohydrates?: number
        protein?: number
        fat?: number
        calories?: number
        sugar?: number
    }
}
