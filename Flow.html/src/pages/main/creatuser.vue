<template>
    <div>
        <subtitle class="paddingtop" content="Create User"></subtitle>
        <inwithicons icon="address-card" placeholder="Username" v-model="username"></inwithicons>
        <inwithicons icon="key" placeholder="Password" v-model="password"></inwithicons>
        <button v-on:click="summit" v-bind:disabled="disabled" type="button" class="am-btn am-btn-default am-btn-block">Submit</button>
    </div>
</template>

<script>
    import inputIcon from '../common/inputicon.vue';
    import SubTitle from '../common/subtitle.vue';
    export default {
        components: {
            "inwithicons": inputIcon,
            "subtitle": SubTitle
        },
        // name: 'example',
        data: function () {
            return {
                username: '',
                password: '',
                disabled: false,
                auth: 'stupidman'
            }
        },
        computed: {

        },
        methods: {
            summit: function () {
                this.$parent.createuser(this.username, this.password, this.auth);
            }
        }
    }
</script>

<style scoped>

</style>