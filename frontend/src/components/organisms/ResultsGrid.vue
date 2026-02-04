<script setup lang="ts">
import GridItem from '../molecules/GridItem.vue';
interface ResultItem {
    id: string
    name: string
};

const props = defineProps<{
    items: ResultItem[]
    loading: boolean
    loadingDetailsId: string | number | null;
}>();

const emit = defineEmits<{
    (e: 'seeDetails', id: string): void
}>();

const displayDetails = (id: string) => emit('seeDetails', id);
</script>

<template>
    <section class="result-container">
        <div v-if="loading" class="state state-loading">
            Searching...
        </div>

        <div v-else-if="items.length === 0" class="state state-empty">
            There are zero matches.<br />
            Use the form to search for People or Movies
        </div>

        <div v-else class="grid">
            <h2 class="result-title">Results</h2>
            <GridItem v-for="value in items"
                :key="value.id"
                :id="value.id"
                :title="value.name"
                :loading="loadingDetailsId === value.id"
                @see-details="displayDetails">
            </GridItem>
        </div>
    </section>
</template>

<style lang="css" scoped>
.result-container {
    width: 100%;
    min-height: 200px;
}

.state {
  height: 100%;
  min-height: 180px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #7a7a7a;
  font-size: 14px;
}

.result-title {
    text-align: left;
    border-bottom: 1px solid #e5e5e5;
    padding-bottom: 5px;
}
</style>