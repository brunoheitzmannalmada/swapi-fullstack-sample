<script setup lang="ts">
import { ref } from 'vue';
import BaseCard from '@/components/atoms/BaseCard.vue';
import SearchForm from '@/components/molecules/SearchForm.vue';
import ResultsGrid from '@/components/organisms/ResultsGrid.vue';
import DetailsOverlay from '@/components/organisms/DetailsOverlay.vue';
import type { SearchParams, SearchResultItem, SearchType } from '@/types/search';
import type { PeopleDetails } from '@/types/people';
import type { MovieDetails } from '@/types/movie';

import { fetchPeople, detailsPeople } from '@/services/people';
import { fetchMovies, detailsMovie } from '@/services/movie';

const loading = ref(false);
const detailsLoading = ref(false);
const showDetails = ref(true);
const loadingDetailsId = ref<string | number | null>(null);
const results = ref<any[]>([]);
const details = ref<PeopleDetails | MovieDetails | null>(null);
const searchType = ref<SearchType>('people');

const handleSearch = async (params: SearchParams) => {
    loading.value = true;
    searchType.value = params.type;

    try {
        const { data } =
            params.type === 'people'
                ? await fetchPeople(params.text)
                : await fetchMovies(params.text);

        results.value =
            params.type === 'people'
                ? mapPeopleResults(data.results)
                : mapMovieResults(data.results);
    } catch (e) {
        console.error(e);
    }
    finally {
        loading.value = false;
    }
}

const displayDetails = async (id: string | number) => {
    loadingDetailsId.value = id;
    detailsLoading.value = true;

    try {
        const { data } =
            searchType.value === 'people'
                ? await detailsPeople(id)
                : await detailsMovie(id);
        showDetails.value = true;

        details.value = data.details;
    }
    catch (e) {
        console.error(e);
    }
    finally {
        loadingDetailsId.value = null;
        detailsLoading.value = false;
    }
};

const mapPeopleResults = (items: any[]): SearchResultItem[] => {
  return items.map(item => ({
    id: item.uid,
    name: item.name
  }));
};

const mapMovieResults = (items: any[]): SearchResultItem[] => {
  return items.map(item => ({
    id: item.uid,
    name: item.properties.title
  }));
};


const closeDetails = () => showDetails.value = false;
</script>

<template>
    <div class="home">
        <BaseCard>
            <SearchForm @doSearch="handleSearch" :loading="loading" />
        </BaseCard>

        <BaseCard style="width: 90%;">
            <ResultsGrid
                :items="results"
                :loading="loading"
                :loading-details-id="loadingDetailsId"
                @see-details="displayDetails"
            />
        </BaseCard>

        <DetailsOverlay
            v-if="showDetails && details"
            :type="searchType"
            :details="details"
            @close="closeDetails"
        >
        </DetailsOverlay>
    </div>
</template>

<style lang="css" scoped>
.home {
    display: grid;
    grid-template-columns: minmax(205px, 320px) 1fr;
    margin-left: 50px;
    margin-top: 25px;
    gap: 24px;
    align-items: start;
}

@media (max-width: 768px) {
    .home {
        grid-template-columns: 1fr;
        margin: 0;
    }
}
</style>