import './bootstrap';
import router from './routes'

//start importing graph components
import GraphOnboarding from './components/graphs/onboarding.vue'

Vue.component('graph-onboading', GraphOnboarding);
//end of importing graph components

const app = new Vue({
    el: '#appAdmin',
    router: router
});