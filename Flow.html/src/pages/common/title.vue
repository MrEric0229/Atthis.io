<template>
    <div class="center">
        <span v-bind:class="titlesstyle">Atthis</span><br>
        <span class="thiscontent">{{compcontent}}</span>
    </div>
</template>

<script>
    export default {
        props: ['content', 'size'],
        name: 'my-title',
        data: function () {
            return {
                compcontent: this.content
            }
        },
        computed: {
            titlesstyle: function () {
                console.log(this.size)
                if (this.size == 'small') {
                    return 'smalltitle';
                } else {
                    return 'thistitle';
                }
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
    .thistitle {
        font-family: 'Meddon', cursive;
        font-size: 72px;
        padding: 0px;
        margin: 0px;
    }

    .smalltitle {
        font-family: 'Meddon', cursive;
        font-size: 48px;
        margin: 0px;
        line-height: 100px;
    }

    .thiscontent {
        padding: 0px;
        margin: 0px;
    }
</style>