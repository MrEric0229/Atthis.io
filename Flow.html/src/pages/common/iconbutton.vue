<template>
    <button v-on:click="onclickfun" class="am-btn am-btn-default am-btn-block"><span>{{content}}&nbsp;|&nbsp;<i v-bind:class="compuedicon"></i></span></button>
</template>

<script>
    // import Registermain from './register/register.vue';
    export default {
        props: ['func', 'argument', 'icon', 'content'],
        computed: {
            compuedicon: function () {
                return 'fa fa-' + this.icon + ' fa-fw';
            }
        },
        methods: {
            onclickfun: function () {
                (this.argument) ? this.func(this.argument): this.func();
            }
        }
    }
</script>
<style scoped>
    button {
        background-color: transparent;
        border: 0px;
        width: 100%;
        height: 35px;
        text-align: right;
    }

    span {
        padding-right: 15px;
    }
</style>