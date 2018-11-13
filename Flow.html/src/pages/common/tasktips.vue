<template>
    <p><i v-bind:class="thisicon"></i><span class="red">{{tips}}</span><span class="yellow">{{content}}</span></p>
</template>

<script>
    export default {
        props: ['icon', 'tips', 'content'],
        computed: {
            thisicon: function () {
                return 'fa fa-' + this.icon + ' fa-fw';
            }
        }
    }
</script>

<style scoped>
    .red {
        background-color: red;
        padding: 0px;
    }

    .yellow {
        background-color: yellow;
        padding: 0px;
        height: 100%;
    }

    span {
        margin: 0px;
        padding: 0px;
        height: 100px;
    }

    p {
        margin: 0px;
        padding: 0px;
        border: 1px solid black;
    }
</style>