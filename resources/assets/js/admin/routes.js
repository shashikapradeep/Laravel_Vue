import VueRouter from 'vue-router';


let routes = [
    {
        path: '/admin/',
        component: require('./pages/home')
    },
    {
        path: '/admin/graph',
        component: require('./pages/graph')
    },
    {
        path: '/admin/about',
        component: require('./pages/about')
    }
]

export default new VueRouter({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active'
});