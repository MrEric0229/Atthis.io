<template>
    <div>
        <navtitle style="padding-top:10px;" v-bind:content="gvar.auth" size="small"></navtitle>
        <hr>
        <iconbutton v-bind:func="checkout" argument="create" icon="id-card" content="Create User"></iconbutton>
        <iconbutton v-bind:func="checkout" argument="update" icon="edit" content="Update Account"></iconbutton>
        <iconbutton v-bind:func="checkout" argument="issue" icon="braille" content="Issue Work"></iconbutton>
        <iconbutton v-bind:func="checkout" argument="track" icon="compass" content="Track Task"></iconbutton>
        <iconbutton v-bind:func="checkstorage" icon="github" content="Test Button"></iconbutton>
    </div>
</template>

<script>
    import IconButton from '../common/iconbutton.vue';
    import Title from '../common/title.vue';
    const requests = require('../../func/requests.js');
    var storage = window.require('electron-json-storage');

    export default {
        components: {
            'iconbutton': IconButton,
            'navtitle': Title
        },
        props: ['gvar'],
        data: function () {
            return {}
        },
        computed: {

        },
        methods: {
            checkout: function (target) {
                this.$parent.checkout(target);
            },
            test: function () {
                console.log('test');
            },
            checkstorage: function () {
                storage.get('token', function (error, data) {
                    if (error) throw error;
                });
            }
        }
    }
</script>

<style scoped>

</style>