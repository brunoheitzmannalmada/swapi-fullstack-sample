<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'

import { fetchPeople } from '@/services/people'
import { fetchStatistics } from '@/services/statistics'

import type { StatisticsResponse } from '@/models/statistics'
import type { PeopleResponse } from '@/models/people'

defineProps<{ msg: string }>()

const txtName = ref('')
const people = ref<PeopleResponse | null>(null)
const statistics = ref<StatisticsResponse | null>(null)
const topQueries = computed(() => statistics.value?.top_queries ?? [])
const peopleResults = computed(() => people.value?.results ?? [])

const count = ref(0)

const searchName = async () => {
  try {
    const { data } = await fetchPeople(txtName.value)

    people.value = data
  }
  catch (e) {
    console.error(e)
  }
}

const getStatistics = async () => {
  try {
    const { data } = await fetchStatistics()

    statistics.value = data
  }
  catch (e) {
    console.error(e)
  }
}

onMounted(getStatistics)
</script>

<template>
  <h1>{{ msg }}</h1>

  <div class="card">
    <button type="button" @click="count++">count is {{ count }}</button>
    <p>
      Edit
      <code>components/HelloWorld.vue</code> to test HMR
    </p>
  </div>

  <div class="card">
    <input v-model="txtName" placeholder="Search" />
    
    <button @click="searchName">Search</button>
  </div>

  <div class="card">
    <ul>
      <li v-for="item in peopleResults" :key="item.uid">
        {{ item.name }}
      </li>
    </ul>
  </div>

  <div class="card">
    Top queries for reference:
    <div class="container">
      <div class="col">Count</div>
      <div class="col">Query</div>
      <div class="col">Percentage</div>
    </div>
    <div class="container" v-for="item in topQueries" :key="item.query">
      <div class="col">{{ item.count }}</div>
      <div class="col">{{ item.query }}</div>
      <div class="col">{{ item.percentage }}</div>
    </div>
    <button @click="getStatistics">Update</button>
  </div>

  <p>
    Check out
    <a href="https://vuejs.org/guide/quick-start.html#local" target="_blank"
      >create-vue</a
    >, the official Vue + Vite starter
  </p>
  <p>
    Learn more about IDE Support for Vue in the
    <a
      href="https://vuejs.org/guide/scaling-up/tooling.html#ide-support"
      target="_blank"
      >Vue Docs Scaling up Guide</a
    >.
  </p>
  <p class="read-the-docs">Click on the Vite and Vue logos to learn more</p>
</template>

<style scoped>
.read-the-docs {
  color: #888;
}

.container {
  display: flex;
  gap: 16px; /* espaço entre colunas */
}

.col {
  flex: 1; /* todas com a mesma largura */
  padding: 8px;
}

</style>
