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
                <h1> Welcome to WMATA Train Viewer! </h1>
                <p> 
                  See all lines below: 
                </p>
                <li v-for="line in lines">
                  <button @click="selectLine(line)">
                    {{ line }}
                  </button>
                </li>
                
            </template>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>

<script setup lang="ts">
    
    import ChooseStation from './ChooseStation.vue';

    let lines: string[] = [];

    function loadLines() {
      //Call localhost:3000/LineService function getAllLines
      lines = ["YL", "GR", "RD"];
    }

    function selectLine(line: string) {
      //Navigate to ChooseStation with line
    }

    loadLines();

</script>
