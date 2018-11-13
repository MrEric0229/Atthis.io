<template>
    <div>
        <smallicon v-for="(b, index) in buttons" v-bind:icon="b.icon" v-bind:content="b.content" v-bind:inde="index" v-bind:selected="selected"></smallicon>
    </div>
</template>

<script>
    import smallIcon from './smallicon.vue';
    export default {
        components: {
            "smallicon": smallIcon
        },
        data: function () {
            return {
                selected: 0
            }
        },
        props: ['buttons'],
        computed: {
            compuedicon: function () {
                return 'fa fa-' + this.icon + ' fa-fw';
            }
        },
        methods: {
            changing: function (inde) {
                this.selected = inde;
                this.$parent.changing(this.buttons[inde].content);
            }
        }
    }
</script>
<style scoped>
    button {
        width: 25%;
    }
</style>