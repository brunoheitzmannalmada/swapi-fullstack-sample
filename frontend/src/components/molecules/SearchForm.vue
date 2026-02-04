<script setup lang="ts">
import { ref } from 'vue';
import BaseRadio from '../atoms/BaseRadio.vue';
import BaseInput from '../atoms/BaseInput.vue';
import BaseButton from '../atoms/BaseButton.vue';
import type { SearchParams } from '@/types/search';
import type { SearchType } from '@/types/search';

const props = defineProps<{
    loading: boolean
}>();

const emit = defineEmits<{
  (e: 'doSearch', payload: SearchParams): void
}>();

const searchType = ref<SearchType>('people');
const searchText = ref('');
const clickButton = () => emit('doSearch', {
    type: searchType.value,
    text: searchText.value
});
</script>

<template>
    <div class="search-container">
        <div>What are you searching for?</div>
        <div class="radio-group">
            <BaseRadio name="searchType" label="People" value="people" v-model="searchType" />
            <BaseRadio name="searchType" label="Movies" value="movie" v-model="searchType" />
        </div>
        <div>
            <BaseInput placeholder="ex. Luke, Darth Vader, Star Wars IV" v-model="searchText" style="width: 90%" />
        </div>
        <div>
            <BaseButton @click="clickButton" :disabled="searchText === '' || loading" :loading="props.loading" class="button">
                Search
                <template #loading>Searching...</template>
            </BaseButton>
        </div>
    </div>
</template>

<style lang="css" scoped>
.search-container {
    display: grid;
    gap: 16px;
}

.radio-group {
    display: flex;
    gap: 12px;
}

.button {
    width: 100%;
}
</style>