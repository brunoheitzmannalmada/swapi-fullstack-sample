<script setup lang="ts">
import { computed } from 'vue';
import type { PeopleDetails } from '@/types/people';
import type { MovieDetails } from '@/types/movie';
import type { SearchType } from '@/types/search';
import BaseButton from '../atoms/BaseButton.vue';

type Details = PeopleDetails | MovieDetails;

const props = defineProps<{
    type: SearchType
    details: Details
}>();

const emit = defineEmits<{
    (e: 'close'): void
}>();

const peopleDetails = computed(() =>
  props.type === 'people'
    ? (props.details as PeopleDetails)
    : null
)

const movieDetails = computed(() =>
  props.type === 'movie'
    ? (props.details as MovieDetails)
    : null
)

const moviesText = computed(() =>
    peopleDetails.value?.films?.length
        ? peopleDetails.value.films.join(', ')
        : 'No films found'
);

const charactersText = computed(() =>
    movieDetails.value?.characters?.length
        ? movieDetails.value.characters.join(', ')
        : 'No characters found'
);
</script>

<template>
    <div class="overlay" @click.self="emit('close')">
        <div class="panel">
            <h2 style="text-align: left;">
                {{ type === 'people' ? (details as PeopleDetails).name : (details as MovieDetails).title }}
            </h2>

            <div class="contentg">
                <div class="content-grid">
                    <div class="column">
                        <h3 class="title">
                            {{ type === 'people' ? 'Details' : 'Opening Crawl' }}
                        </h3>
                        <template v-if="type === 'people' && peopleDetails">

                            <p><strong>Birth year:</strong> {{ peopleDetails.birth_year }}</p>
                            <p><strong>Gender:</strong> {{ peopleDetails.gender }}</p>
                            <p><strong>Eye Color:</strong> {{ peopleDetails.eye_color }}</p>
                            <p><strong>Hair Color:</strong> {{ peopleDetails.hair_color }}</p>
                            <p><strong>Height:</strong> {{ peopleDetails.height }}</p>
                            <p><strong>Mass:</strong> {{ peopleDetails.skin_color }}</p>
                        </template>

                        <template v-else-if="movieDetails">
                            {{ movieDetails.opening_crawl }}
                        </template>

                    </div>
                    <div class="column">
                        <h3 class="title">
                            {{ type === 'people' ? 'Movies' : 'Characters' }}
                        </h3>

                        <template v-if="type === 'people'">
                            {{ moviesText }}
                        </template>

                        <template v-else>
                            {{ charactersText }}
                        </template>
                    </div>
                </div>
            </div>

            <div class="actions">
                <BaseButton @click="emit('close')" class="button">
                    Back to search
                </BaseButton>
            </div>
        </div>
    </div>
</template>


<style lang="css" scoped>
.overlay {
  position: fixed;
  inset: 0;
  z-index: 1000;

  background-color: rgba(0, 0, 0, 0.3);

  display: flex;
  align-items: center;
  justify-content: center;
}

.panel {
  background-color: #fff;
  width: 100%;
  max-width: 800px;

  max-height: 90vh;

  display: flex;
  flex-direction: column;

  padding: 24px;
  border-radius: 8px;

  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}

.contentg {
  flex: 1;
  overflow-y: auto;
  margin: 16px 0;

  -webkit-overflow-scrolling: touch;
}

.content-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}

.column {
  display: flex;
  flex-direction: column;
  gap: 8px;
  text-align: left;
}

.column > p {
  margin: 1px;
}

.title {
  border-bottom: 1px solid #c4c4c4;
  padding-bottom: 5px;
}

.actions {
  padding-top: 16px;
  border-top: 1px solid #eee;
  background: #fff;
  text-align: left;
}

@media (max-width: 768px) {
    .panel {
        height: 100dvh;
        max-height: 100dvh;
        border-radius: 0;
    }

    .content-grid {
        grid-template-columns: 1fr;
    }

    .actions {
        position: sticky;
        bottom: 0;
    }

    .actions > .button {
        width: 100%;
    }
}
</style>