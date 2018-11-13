<template>
    <div>
        <scard icon="user-circle-o" tips="tips" v-bind:content="task.seller"></scard>
        {{task}}
        <hr>
    </div>
</template>

<script>
    import Card from './tasktips.vue';
    export default {
        components: {
            'scard': Card
        },
        props: ['task'],
        data: function () {
            return {}
        },
        computed: {

        },
        methods: {
            toicon: function (i) {
                return 'fa fa-' + i + ' fa-fw';
            }
        }
    }
</script>

<style scoped>

</style>