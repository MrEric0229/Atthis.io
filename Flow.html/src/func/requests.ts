declare var require, module: any;
const request = require('request');
const loginapis = {
    login: function (username: string, password: string, func: Function) {
        request.post({
            url: 'http://flow.sushithedog.com/test/Login.php',
            form: {
                mode: 'up',
                username: username,
                password: password
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            func(JSON.parse(body));
        });
    },
    token: function (token: string, func: Function) {
        request.post({
            url: 'http://flow.sushithedog.com/test/Login.php',
            form: {
                mode: 'token',
                token: token
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            func(JSON.parse(body));
        });
    },
    createTask: function () {
        request.post({
            url: 'http://flow.sushithedog.com/test/action.php',
            form: {
                mode: 'createTask',
                officer1: 1,
                officer2: 2,
                seller: 'Weng WeiHong',
                carInfo: 'HaLanDa',
                vin: 'wengweihongshishabi',
                note: '拒绝黄赌毒'
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            console.log(JSON.parse(body));
        });
    },
    getavaiablerole: function (func: Function) {
        request.post({
            url: 'http://flow.sushithedog.com/test/action.php',
            form: {
                mode: 'RoleIndexAction'
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            func(JSON.parse(body));
        });
    },
    getalluser: function (func: Function) {
        request.post({
            url: 'http://flow.sushithedog.com/test/action.php',
            form: {
                mode: 'UserIndexAction'
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            func(JSON.parse(body));
        });
    },
    // this function is such a mass!!!!!!!!!!!!!!!
    updateuser: function (username: string, password: string, auth: string, token: string, id: any, func: Function) {
        request.post({
            url: 'http://flow.sushithedog.com/test/action.php',
            form: {
                mode: 'EditAction',
                id: username,
                password: password,
                authority: auth
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            func(JSON.parse(body));
        });
    },
    getMyTask: function (id: number, auth: string, func: Function) {
        request.post({
            url: 'http://flow.sushithedog.com/test/action.php',
            form: {
                mode: 'getTask',
                id: id,
                authority: auth
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            func(JSON.parse(body));
        });
    },
    createuser: function (username: string, password: string, auth: string, token: string, func: Function) {
        request.post({
            url: 'http://flow.sushithedog.com/test/signup.php',
            form: {
                username: username,
                password: password,
                token: token,
                authority: auth
            }
        }, function (err, httpResponse, body) {
            if (err)
                throw err;
            func(JSON.parse(body));
        });
    }
}
module.exports = loginapis;