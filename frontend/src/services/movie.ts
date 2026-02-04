import { api } from '@/services/api';

export const fetchMovies = (name: string) => api.get('/star-wars/movies', {
    params: { search: name }
});

export const detailsMovie = (id: string | number) => api.get(`/star-wars/movies/${id}`);