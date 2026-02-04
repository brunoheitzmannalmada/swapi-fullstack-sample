<script setup lang="ts">
interface RadioProps {
  name: string
  value: string
  modelValue: string
  label: string
}

const props = defineProps<RadioProps>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>();

const onChange = () => {
  emit('update:modelValue', props.value)
};
</script>

<template>
  <label class="base-radio">
    <input
      type="radio"
      :name="name"
      :value="value"
      :checked="modelValue === value"
      @change="onChange"
    />

    <span class="radio-control">
      <span class="radio-dot" />
    </span>

    <span class="radio-label">{{ label }}</span>
  </label>
</template>

<style lang="css" scoped>
.base-radio {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  user-select: none;
}

/* Esconde o radio nativo */
.base-radio input {
  position: absolute;
  opacity: 0;
  pointer-events: none;
}

/* Círculo externo */
.radio-control {
  width: 14px;
  height: 14px;
  border: 2px solid #0094ff; /* emerald */
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Bolinha interna */
.radio-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: #0094ff;
  opacity: 0;
  transition: opacity 0.15s ease;
}

/* Estado checked */
.base-radio input:checked + .radio-control .radio-dot {
  opacity: 1;
}

/* Texto */
.radio-label {
  font-size: 14px;
  color: #222;
}

</style>