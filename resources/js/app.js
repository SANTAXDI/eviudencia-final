require('./bootstrap');

window.Vue = require('vue')

Vue.component('category-main-component', require('./categories/components/CategoryMain.vue').default)
Vue.component('movie-main-component', require('./movies/components/MovieMain.vue').default)
Vue.component('rental-main-component', require('./rentals/components/RentalMain.vue').default)
Vue.component('role-main-component', require('./roles/components/RoleMain.vue').default)
Vue.component('status-main-component', require('./statuses/components/StatusMain.vue').default)
Vue.component('typestatus-main-component', require('./typeStatuses/components/TypeStatusMain.vue').default)
Vue.component('user-main-component', require('./users/components/UserMain.vue').default)
new Vue({
	el: "#app"
})