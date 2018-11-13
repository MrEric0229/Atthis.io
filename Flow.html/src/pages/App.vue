<template>
  <div class="container-fluid minheight">
    <registermain v-if="page=='register'"></registermain>
    <mainpage v-if="page=='main'" v-bind:gvar="gvar"></mainpage>
  </div>
</template>

<script>
  // var a = window.require('electron');
  import Registermain from './register/register.vue';
  import Main from './main/main.vue';
  export default {
    components: {
      "registermain": Registermain,
      "mainpage": Main
    },
    name: 'app',
    data: () => {
      return {
        gvar: {
          username: '',
          auth: 'test',
          token: ''
        },
        page: 'register'
      }
    },
    methods: {
      switchto: function (page) {
        this.page = page;
      },
      globolusername: function (username, auth, token) {
        this.gvar.username = username;
        this.gvar.auth = auth;
        this.gvar.token = token;
      }
    }
  }
</script>

<style>
  .common-padding {
    padding-top: 45px;
  }

  .center {
    text-align: center;
  }
</style>