<template>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <my-title class="padding" size="big" content="A work flow tracking system"></my-title>
            <login-form></login-form>
        </div>
    </div>
</template>

<script>
    import MyTitle from '../common/title.vue';
    import LoginForm from './loginform.vue';
    export default {
        components: {
            MyTitle,
            LoginForm
        },
        name: 'registermain',
        data: function () {
            return {}
        },
        methods: {
            loginstatus: function (status, username, auth, token) {
                if (status) {
                    this.$parent.switchto('main');
                    this.$parent.globolusername(username, auth, token);
                }
            }
        }
    }
</script>

<style scoped>
    .padding {
        padding-top: 10%;
    }
</style>