import { api } from '@/services/api';
import type { PeopleResponse } from '@/models/people';
import type { PeopleDetailsResponse } from '@/types/people';

export const fetchPeople = (name: string) => api.get<PeopleResponse>('/star-wars/people', {
    params: { search: name }
});

export const detailsPeople = (id: string | number) => api.get<PeopleDetailsResponse>(`/star-wars/people/${id}`);