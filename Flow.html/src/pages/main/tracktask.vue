<template>
    <div>
        <subtitle class="paddingtop" content="Track Task"></subtitle>
        <userlist v-if="display=='select'" v-for="i in userlist" v-bind:func="selectuser" v-bind:argument="i.id" v-bind:argument2="i.authority"
            v-bind:username="i.userName" v-bind:role="i.authority" v-bind:id="i.id"></userlist>
        <taskview v-if="display=='view'" v-bind:tasks="tasklist"></taskview>
    </div>
</template>

<script>
    import SubTitle from '../common/subtitle.vue';
    import UserList from '../common/userlist.vue';
    import TaskView from './taskview.vue';

    export default {
        components: {
            "subtitle": SubTitle,
            "userlist": UserList,
            "taskview": TaskView
        },
        props: ['tasklist', 'userlist'],
        data: function () {
            return {
                auth: '',
                id: '',
                disabled: false,
                display: 'select',
            }
        },
        computed: {

        },
        methods: {
            selectuser: function (id, auth) {
                this.auth = auth;
                this.id = id;
                this.$parent.getTasks(id, auth);
                this.display = 'view';
            },
        }
    }
</script>

<style scoped>

</style>