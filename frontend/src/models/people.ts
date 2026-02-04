export interface People {
    uid: string
    name: string
    url: string
}

export interface PeopleResponse {
    count: number
    results: People[]
}