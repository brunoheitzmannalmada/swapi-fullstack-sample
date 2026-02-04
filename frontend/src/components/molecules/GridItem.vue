<script setup lang="ts">
import BaseButton from '../atoms/BaseButton.vue';

const emit = defineEmits<{
  (e: 'seeDetails', id: string): void
}>();

const props = defineProps<{
    id: string
    title: string,
    loading: boolean
}>();

const seeDetails = () => emit('seeDetails', props.id);
</script>

<template>
    <div class="grid-item-container">
        <h3 class="title">{{ title }}</h3>
        <div class="details">
            <BaseButton @click="seeDetails" :loading="loading" :disabled="loading" class="button">
                See details
                <template #loading>
                    Loading details...
                </template>
            </BaseButton>
        </div>
    </div>
</template>

<style lang="css" scoped>
.grid-item-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #e5e5e5;
}

.grid-item-container:last-child {
    border-bottom: none;
}

.title {
    text-align: left;
}

.details {
    text-align: right;
}

@media (max-width: 768px) {
    .grid-item-container {
        grid-template-columns: 1fr;
    }

    .details {
        text-align: initial;
    }

    .details > .button {
        width: 100%;
        font-weight: bolder;
    }
}
</style>