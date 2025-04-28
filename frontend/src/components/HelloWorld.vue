<template>
  <v-container class="fill-height" max-width="900">
    <div>
      <v-row>
        <v-col cols="12">
          <v-card
            class="py-4"
            color="surface-variant"
            image="https://cdn.vuetifyjs.com/docs/images/one/create/feature.png"
            rounded="lg"
            variant="tonal"
          >
            <template #title>
              <h2 class="text-h5 font-weight-bold">
                {{ helloWorldText }}
              </h2>
            </template>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>

<script setup lang="ts">
  import axios from 'axios';
  import { ref } from 'vue';

  const helloWorldText = ref('loading...');

  const loadText = async () => {
    const response = await axios.get('http://localhost:8000/hello-world');
    helloWorldText.value = response.data;
  };
  loadText();
</script>
