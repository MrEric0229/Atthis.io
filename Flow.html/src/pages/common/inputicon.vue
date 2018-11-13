<template>
    <div class="am-input-group">
        <span class="am-input-group-label">
    <i v-bind:class="fixedicon"></i>
    </span>
        <input type="text" class="am-form-field" v-bind:placeholder="placeholder" v-on:input="updatevalue($event.target.value)">
    </div>
</template>

<script>
    export default {
        name: 'inwithicon',
        props: ['icon', 'placeholder', 'value'],
        computed: {
            fixedicon: function () {
                return 'fa fa-' + this.icon + ' fa-fw';
            }
        },
        methods: {
            startthis: function () {},
            updatevalue: function (value) {
                this.$emit('input', value);
            },
        }
    }
</script>