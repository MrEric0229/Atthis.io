<template>
    <div>
        <span>Editing -> {{edituser}}: </span>
        <inwithicons icon="key" placeholder="Password" v-model="password"></inwithicons>
        <span>Role: </span>
        <selectgroup v-bind:buttons="roletobuttons"></selectgroup>
        <button v-on:click="summit" v-bind:disabled="disabled" type="button" class="am-btn am-btn-default am-btn-block">Submit</button>
    </div>
</template>

<script>
    import inputIcon from '../common/inputicon.vue';
    import selectGroup from '../common/selectbuttongroup.vue';

    export default {
        components: {
            "inwithicons": inputIcon,
            "selectgroup": selectGroup
        },
        props: ['username', 'authorize', 'avaiablerole'],
        data: function () {
            return {
                edituser: this.username,
                password: '',
                disabled: false,
                auth: ''
            }
        },
        computed: {
            roletobuttons: function () {
                let caa = [];
                for (let i = 0; i < this.avaiablerole.length; i++) {
                    let icon = 'question';
                    switch (this.avaiablerole[i].role) {
                        case 'admin':
                            icon = 'buysellads'
                            break;
                        case 'seller':
                            icon = 'link';
                            break;
                        case 'accounting':
                            icon = 'money';
                            break;
                    }
                    let p = {
                        icon: icon,
                        content: this.avaiablerole[i].role
                    }
                    caa.push(p);
                }
                return caa;
            }
        },
        methods: {
            changing: function (inde) {
                this.auth = inde;
            },
            summit: function () {
                if (this.auth.length < 1) {
                    this.auth = this.avaiablerole[0].role;
                }
                this.$parent.summit(this.edituser, this.password, this.auth);
            }
        }
    }
</script>

<style scoped>

</style>