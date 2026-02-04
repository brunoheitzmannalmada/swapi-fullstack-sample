export type SearchType = 'people' | 'movie';

export interface SearchParams {
    type: SearchType
    text: string
}

export interface SearchResultItem {
    id: string;
    name: string
}