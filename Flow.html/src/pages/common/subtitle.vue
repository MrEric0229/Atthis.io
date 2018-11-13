<template>
    <div class="center">
        <span class="thistitle">{{this.content}}</span><br>
    </div>
</template>

<script>
    export default {
        props: ['content']
    }
</script>

<style scoped>
    .thistitle {
        font-family: 'Indie Flower', cursive;
        font-size: 43px;
        padding: 0px;
        margin: 0px;
    }

    .thiscontent {
        padding: 0px;
        margin: 0px;
    }
</style>