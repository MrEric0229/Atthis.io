<template>
    <div class="row minheight">
        <div class="col-sm-3 nav bg">
            <navbar v-bind:gvar="gvar"></navbar>
        </div>
        <div class="col-sm-9">
            <myview v-bind:display="display" v-bind:gvar="gvar"></myview>
        </div>
    </div>
</template>

<script>
    import NavBar from './navbar.vue';
    import View from './displayarea.vue';
    export default {
        components: {
            'navbar': NavBar,
            'myview': View
        },
        props: ['gvar'],
        data: function () {
            return {
                display: 'none'
            }
        },
        computed: {

        },
        methods: {
            checkout: function (target) {
                this.display = target;
            }
        }
    }
</script>

<style scoped>
    .bg {
        background-color: #d0d0d0;
        min-height: 100%;
        height: 100%;
        padding: 0px;
    }
</style>