<template>
  <v-app>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script lang="ts" setup>
import { ref, computed } from 'vue'

import ChooseStation from './components/stations/ChooseStation.vue';
import ChooseLine from './components/lines/ChooseLine.vue';
import NextTrain from './components/trains/NextTrain.vue'

  const routes = {
    '/chooseStation': ChooseStation,
    '/chooseLine': ChooseLine,
    '/nextTrain': NextTrain
  
  }

  const currentPath = ref(window.location.hash)

  window.addEventListener('hashchange', () => {
    currentPath.value = window.location.hash
  })

  const currentView = computed(() => {
    // return routes[currentPath.value.slice(1)]
  })
</script>
