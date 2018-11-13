<template>
    <div>
        <subtitle class="paddingtop" content="Issue Work"></subtitle>
        <inwithicons icon="user" placeholder="Seller" v-model="seller"></inwithicons><br>
        <inwithicons icon="car" placeholder="Car Information" v-model="carInfo"></inwithicons>
        <inwithicons icon="info" placeholder="VIN Number" v-model="vin"></inwithicons><br>
        <inwithicons icon="user" placeholder="Set to Seller" v-model="officer1"></inwithicons>
        <inwithicons icon="user" placeholder="Set to Accounting" v-model="officer2"></inwithicons><br>
        <button v-on:click="summit" v-bind:disabled="disabled" type="button" class="am-btn am-btn-default am-btn-block">Submit</button>
    </div>
</template>

<script>
    // import Registermain from './register/register.vue';
    import inputIcon from '../common/inputicon.vue';
    import SubTitle from '../common/subtitle.vue';
    export default {
        components: {
            "inwithicons": inputIcon,
            "subtitle": SubTitle
        },
        props: ['example'],
        // name: 'example',
        data: function () {
            return {
                seller: '',
                carInfo: '',
                vin: '',
                officer1: '',
                officer2: ''
            }
        },
        computed: {

        },
        methods: {
            summit: function () {
                //this.$parent.createuser(this.username, this.password, this.auth);
                console.log(this.seller);
            }
        }
    }
</script>

<style scoped>

</style>