<script setup lang="ts">
withDefaults(
    defineProps<{
        disabled?: boolean;
        loading?: boolean;
    }>(), {
    disabled: false,
    loading: false
});
const emit = defineEmits<{
    (e: 'click'): void;
}>();
</script>

<template>
    <button type="button"
        @click="emit('click')" 
        class="button-base"
        :class="{
            'button-disabled': disabled,
            'button-enabled': !disabled
        }"
        :disabled="disabled">
        <template v-if="loading">
            <slot name="loading"></slot>
        </template>
        <template v-else>
            <slot />
        </template>
    </button>
</template>

<style lang="css" scoped>
.button-base {
  margin: 10px 0 0;
  border-radius: 10px;
  color: #FFF;
}

.button-disabled {
  border: solid 0.5px #c4c4c4;
  background-color: #c4c4c4;
  cursor: not-allowed;
}

.button-enabled {
  border: solid 0.5px #0ab463;
  background-color: #0ab463;
}
</style>