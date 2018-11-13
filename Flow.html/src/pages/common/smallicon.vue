<template>
    <button v-on:click="onclickfun" class="am-btn am-btn-default" v-bind:class="isselected"><span><i v-bind:class="compuedicon"></i>&nbsp;|&nbsp;{{content}}</span></button>
</template>

<script>
    export default {
        props: ['inde', 'selected', 'icon', 'content'],
        computed: {
            compuedicon: function () {
                return 'fa fa-' + this.icon + ' fa-fw';
            },
            isselected: function () {
                if (this.inde == this.selected) {
                    return 'selected';
                } else {
                    return '';
                }
            }
        },
        methods: {
            onclickfun: function () {
                this.$parent.changing(this.inde);
            }
        }
    }
</script>
<style scoped>
    button {
        width: 25%;
    }

    .selected {
        background-color: #ffd13a
    }
</style>