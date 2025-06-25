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
                    Please enter username and password below:
                </p>
                <input>
                <input>
                <button @click="login()">Submit</button>
                <button @click="forgotPassword()">Forgot Password </button>
                
                
            </template>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>

<script setup lang="ts">
    
    import HomePage from '../HomePage.vue';
    import ForgotPassword from './ForgotPassword.vue';
    import MultiFactorAuth from './MultiFactorAuth.vue';
    //In the future, we could use https://www.npmjs.com/package/ngx-cookie-service or 
    //VueCookies from 'vue-cookies' to save login information

    function login() {
        //Route to MFA if successful
    }

    function forgotPassword(){
        //Route to ForgotPassword
    }

</script>
