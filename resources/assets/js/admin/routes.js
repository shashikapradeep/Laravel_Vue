import VueRouter from 'vue-router';


let routes = [
    {
        path: '/Admin/',
        component: require('./pages/home')
    },
    {
        path: '/Admin/about',
        component: require('./pages/about')
    }
]

export default new VueRouter({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active current'
});