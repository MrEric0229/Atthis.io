<template>
    <div>
        <taskcard v-for="t in tasks" v-bind:task="t"></taskcard>
    </div>
</template>

<script>
    import TaskCard from '../common/taskcard.vue';

    export default {
        components: {
            "taskcard": TaskCard
        },
        props: ['tasks'],
        data: function () {
            return {}
        },
        computed: {

        },
        methods: {

        }
    }
</script>

<style scoped>

</style>