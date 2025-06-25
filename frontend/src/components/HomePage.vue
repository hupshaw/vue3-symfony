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
                <p> You have the option to a. select a station from all lines, 
                    b. select a line, or c. view upcoming trains at most recently
                    viewed station
                </p>
                <!-- Previews of Each Page with hrefs to main pages -->
                <div style="overflow: hidden; height: 75px">
                    <a href="#/chooseStation">See All Stations: </a>
                    <ChooseStation />
                </div> 
                <div style="overflow: hidden; height: 75px">
                    <a href="#/chooseLine">Select a line: </a>
                    <ChooseLine />
                </div> 
                <div style="overflow: hidden; height: 75px">
                  <!-- In the future, we could cache/save preferredStation locally: -->
                  <!-- <a href="#/nextTrain">View trains for {{ preferredStation.name }}</a> -->
                   <!-- Pass preferredStation to this instance of NextTrain to display relevant train info -->
                  <NextTrain station="{{ preferredStation }}"/>
                </div>
                
                
            </template>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>

<script setup lang="ts">
    
  import ChooseStation from './stations/ChooseStation.vue';
  import ChooseLine from './lines/ChooseLine.vue';
  import NextTrain from './trains/NextTrain.vue'
  //In the future:, we could use cookies with this library:
  //import VueCookies from 'vue-cookies'
  //Alternatively, we could use https://www.npmjs.com/package/ngx-cookie-service for cookies
  import type { Station } from '../models/StationModels'  
  import { ref } from 'vue';


  //let preferredStation = ref<Station>();

  //If caching is enabled, one option would be to save recently viewed stations
  //to view trains from there
  function loadCookies() {
    //  const $cookies = inject<VueCookies>('$cookies'); 
    //if $cookies.get(station)  {
      //preferredStation = $cookies.get(station);
    //}                         

  }

  loadCookies();

</script>
