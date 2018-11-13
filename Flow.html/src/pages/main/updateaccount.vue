<template>
    <div>
        <subtitle class="paddingtop" content="Update Account"></subtitle>
        <userlist v-if="display=='select'" v-for="i in userlist" v-bind:func="selectuser" v-bind:argument="i.id" v-bind:argument2="i.authority"
            v-bind:username="i.userName" v-bind:role="i.authority" v-bind:id="i.id"></userlist>
        <updateview v-bind:username="id" v-bind:authorize="auth" v-bind:avaiablerole="avaiablerole" v-if="display=='view'"></updateview>
    </div>
</template>

<script>
    import SubTitle from '../common/subtitle.vue';
    import UserList from '../common/userlist.vue';
    import UpdateView from './updateview.vue';
    export default {
        components: {
            "subtitle": SubTitle,
            "userlist": UserList,
            "updateview": UpdateView
        },
        props: ['userlist', 'avaiablerole'],
        data: function () {
            return {
                username: '',
                id: '',
                password: '',
                disabled: false,
                display: 'select',
                auth: ''
            }
        },
        computed: {

        },
        methods: {
            selectuser: function (id, auth) {
                (auth) ? this.auth = auth: this.auth = "";
                this.id = id;
                this.display = 'view';
            },
            summit: function (user, pass, auth, id) {
                this.display = 'select';
                this.$parent.updateuser(user, pass, auth, id);
            }
        }
    }
</script>

<style scoped>

</style>