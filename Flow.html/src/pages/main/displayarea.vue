<template>
    <div>
        <creatuser v-if="display == 'create'"></creatuser>
        <issuword v-if="display == 'issue'"></issuword>
        <updateuser v-if="display == 'update'" v-bind:avaiablerole="avaiablerolelist" v-bind:userlist="userlist"></updateuser>
        <tracktask v-if="display == 'track'" v-bind:userlist="userlist" v-bind:tasklist="tasklist"></tracktask>
    </div>
</template>

<script>
    import CreatUser from './creatuser.vue';
    import IssueWork from './issueWork.vue';
    import UpdateUser from './updateaccount.vue';
    import TrackTask from './tracktask.vue';
    const requests = require('../../func/requests.js');
    export default {
        components: {
            'creatuser': CreatUser,
            'issuword': IssueWork,
            'updateuser': UpdateUser,
            'tracktask': TrackTask
        },
        // name: 'example',
        props: ['display', 'gvar'],
        data: function () {
            this.getallusers();
            return {
                userlist: [],
                tasklist: [],
                avaiablerolelist: []
            }
        },
        computed: {

        },
        methods: {
            getallusers: function () {
                requests.getavaiablerole((data) => {
                    this.avaiablerolelist = data;
                })
                requests.getalluser((data) => {
                    this.userlist = data;
                });
            },
            getTasks: function (id, auth) {
                requests.getMyTask(id, auth, (data) => {
                    this.tasklist = data;
                });
            },
            createuser: function (username, password, auth) {
                requests.createuser(username, password, auth, this.gvar.token, (data) => {
                    console.log(data);
                });
            },
            updateuser: function (username, password, auth, id) {
                requests.updateuser(username, password, auth, this.gvar.token, id, (data) => {
                    requests.getalluser((data) => {
                        this.userlist = data;
                        console.log(data);
                    });
                    console.log(data);
                });
            },
            test: function () {
                requests.createTask();
            }
        }
    }
</script>

<style>
    .paddingtop {
        padding-top: 10%;
    }
</style>