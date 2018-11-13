<template>
    <button v-on:click="onclickfun" class="am-btn am-btn-default am-btn-block"><span><i v-bind:class="compuedicon"></i>&nbsp;|&nbsp;{{username}}</span></button>
</template>

<script>
    // import Registermain from './register/register.vue';
    export default {
        props: ['func', 'argument', 'argument2', 'role', 'username', 'id'],
        computed: {
            compuedicon: function () {
                switch (this.role) {
                    case 'accounting':
                        return 'fa fa-money fa-fw';
                    case 'seller':
                        return 'fa fa-link fa-fw';
                    case 'admin':
                        return 'fa fa-buysellads fa-fw';
                    case 'superAdmin':
                        return 'fa fa-address-book fa-fw';
                    default:
                        return 'fa fa-bullseye fa-fw';
                }
            }
        },
        methods: {
            onclickfun: function () {
                (this.argument) ? (this.argument2) ? this.func(this.argument, this.argument2): this.func(this.argument):
                    this.func();
            }
        }
    }
</script>
<style scoped>
    button,
    span {
        text-align: left;
        padding-left: 45px;
    }
</style>