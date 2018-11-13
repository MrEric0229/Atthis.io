<template>
    <div>
        <br>
        <span>{{output}}</span>
        <div v-if="display">
            <inwithicons icon="address-card" placeholder="Username" v-model="username"></inwithicons>
            <inwithicons icon="key" placeholder="Password" v-model="password"></inwithicons>
            <button v-on:click="login" v-bind:disabled="disabled" type="button" class="am-btn am-btn-default am-btn-block">Login</button>
        </div>
    </div>
</template>

<script>
    import LoginIcon from '../common/inputicon.vue';
    const requests = require('../../func/requests.js');
    var storage = window.require('electron-json-storage');
    export default {
        components: {
            "inwithicons": LoginIcon
        },
        props: [],
        name: 'login-form',
        data: function () {
            this.checkstorage();
            return {
                username: '',
                password: '',
                display: false,
                output: 'Connecting...'
            }
        },
        computed: {

        },
        methods: {
            checkstorage: function () {
                storage.get('token', (error, data) => {
                    if (error) throw error;
                    if (data.token) {
                        this.loginwithtoken(data.token);
                    } else {
                        this.display = true;
                        this.output = 'Login with ADMIN username/ password to continue.';
                    }
                    console.log(data);
                });
            },
            loginwithtoken: function (token) {
                requests.token(token, (data) => {
                    if (data.status == "succeed" && (data.authority == 'admin' || data.authority ==
                            'superAdmin')) {
                        this.$parent.loginstatus(true, data.username, data.authority, data.token);
                    } else {
                        this.display = true;
                        this.output = 'Login with ADMIN username/ password to continue.';
                    }
                })
            },
            login: function () {
                requests.login(this.username, this.password, (data) => {
                    if (data.status == "succeed") {
                        if (data.authority == 'admin' || data.authority ==
                            'superAdmin') {
                            this.$parent.loginstatus(true, data.username, data.authority, data.token);
                            storage.set('token', {
                                token: data.token
                            }, function (error) {
                                if (error) throw error;
                            });
                        } else {
                            this.output = 'Only Admin and SuperAdmin could use this system';
                        }
                    } else {
                        this.output = 'Passowrd is not correct or Username not exist';
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>