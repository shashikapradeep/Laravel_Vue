import VueRouter from 'vue-router';


let routes = [
    {
        path: '/',
        component: require('./pages/home')
    }
]

export default new VueRouter({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active current'
});