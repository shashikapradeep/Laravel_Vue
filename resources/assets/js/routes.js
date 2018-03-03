import VueRouter from 'vue-router';


let routes = [
    {
        path: '/',
        component: require('./pages/home')
    },
    {
        path: '/about',
        component: require('./pages/about')
    }
]

export default new VueRouter({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active current'
});