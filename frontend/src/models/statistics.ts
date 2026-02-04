export interface TopQuery {
    query: string
    count: number
    percentage: number
}

export interface StatisticsResponse {
    id: number
    total_searches: number
    top_queries: TopQuery[]
    created_at: string
    updated_at: string
}