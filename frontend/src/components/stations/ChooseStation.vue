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
                Choose a train station!
                <!-- This could be added in the future if we implemented line selection: -->
                <!-- Optionally, select a line:  -->
              </h2>  
              <div v-if="nextTrainList[0]">
                <span v-if="+nextTrainList[0].minutes > 1">              
                  The next train will be arriving in {{nextTrainList[0].minutes}} minutes.
                </span>
                <span v-if="+nextTrainList[0].minutes == 1">              
                  The next train will be arriving in 1 minute.
                </span>
                <span v-if="nextTrainList[0].minutes === 'ARR'">     
                  The next train is arriving now.
                </span>
                <span v-if="nextTrainList[0].minutes === 'BRD'">     
                  The next train is boarding now.
                </span>
              </div>
              <span v-if="errorMessage"> 
                {{ errorMessage }}
              </span>
              <ul>
                <li v-if="!nextTrainList[0]" v-for="station in stationList">
                  <button @click="selectStation(station)">
                    {{ station.name }}
                  </button>
                </li>
              </ul>

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
  import type { Station } from '../../models/StationModels';
  import type { Train } from '../../models/TrainModels';

  //If the user wants to filter by line, this line code will be passed from ChooseLine
  const props = defineProps(['lineCode']);

  const stationList = ref<Station[]>([]);
  const nextTrainList = ref<Train[]>([]);

  const displayMessage = ref('');
  const errorMessage = ref('');

  const loadStationList = async () => {
    const response = await axios.get('http://localhost:8000/getStationList');
    stationList.value = response.data;
  };

  async function selectStation(selectedStation: Station) {
    //In the future, this would be added to the NextTrain.vue component as the application expands
    try {
        //To add caching, in the future I would use vue cookies to save the station_code and name for future use
        //$cookies.set({code: selectedStation.station_code, name: selectedStation.name});
        const response = await axios.get(`http://localhost:8000/getNextTrains/${selectedStation.station_code}`);
        nextTrainList.value = response.data;
        formatDisplayMessage(response.data);
      } catch (error) {
        formatErrorMessage(error);
      }
  }


  //In the future: replace template conditionals with this function
  //To expand, get line information, as well as similar lines at this station
  //using the line scripts
  // function formatDisplayMessage(trainData) {
  //   let nextTrainETA = trainData[0].minutes;
  //   console.log(nextTrainETA);

  //   if (nextTrainETA === "BRD") {
  //     displayMessage.value = "The next train is boarding now.";
  //   } else if (nextTrainETA === "ARR") {
  //     displayMessage.value = "The next train is arriving now.";
  //   } else if (nextTrainETA > 1) {
  //     console.log("ONE");
  //     displayMessage = "The next train will be arriving in" + nextTrainList[0].minutes + "minutes."
  //   } else if (nextTrainETA === 1) {
  //     displayMessage.value = "The next train will be arriving in 1 minute."
  //     console.log("ONE more!");
  //   } else {
  //     formatErrorMessage("Train ETA is : " . trainData);
  //   }
  // }

  function formatErrorMessage(err) {
    errorMessage.value = "We're sorry. An error has occurred: " . err;
  }

  loadStationList();

</script>
