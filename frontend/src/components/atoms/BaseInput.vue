<script setup lang="ts">
interface InputProps {
  name?: string;
  modelValue: string;
  placeholder?: string;
}

defineProps<InputProps>();

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void;
}>();
</script>

<template>
  <input
    type="text"
    class="base-text"
    :name="name"
    :placeholder="placeholder"
    :value="modelValue"
    @input="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
  />
</template>

<style lang="css" scoped>
.base-text {
    padding: 5px;
    border-radius: 2px;
    border: solid 0.5px #383838;
    background-color: #fff;
}
</style>